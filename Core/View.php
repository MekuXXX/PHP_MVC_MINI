<?php

declare(strict_types=1);
namespace App\Core;

class View
{
  private string $DEFAULT_LAYOUT = "_layout";
  private string $DEFAULT_PAGE = "_page";

  protected function addPrefix(string $view) 
  {
    return str_contains($view, '.php') ? $view : "$view.php";
  }

  
  protected function readTemplate(string $view, array $params = []): string
  {
    foreach ($params as $key => $value)
    {
      $$key = $value;
    }

    ob_start();
    include_once Application::$ROOT_VIEW_DIR . $this->addPrefix($view);
    return ob_get_clean();
  }

  protected function checkDefaultLayout(string $path): string
  {
    if (is_dir(Application::$ROOT_VIEW_DIR . $path))
    {
      return $path . '/' . $this->DEFAULT_LAYOUT;
    }

    $pathArray = explode("/", $path);
    $pathLen = count($pathArray);
    
    for ($i = $pathLen - 2; $i >= 0; --$i)
    {
      
      $filePath = implode("/", array_slice($pathArray, 0, $i + 1)) . '/' . $this->addPrefix($this->DEFAULT_LAYOUT);
      if (file_exists(Application::$ROOT_VIEW_DIR . $filePath))
      {
        return $filePath;
      }
    }

    return $this->DEFAULT_LAYOUT;
  }

  public function renderView(string $view,?array $params = [], ?string $layout = null): string
  {
    
    if ($layout === null) 
    {
      $layout = $this->checkDefaultLayout($view);
    }
    else if (!file_exists(Application::$ROOT_VIEW_DIR . $this->addPrefix($layout)) && is_dir(Application::$ROOT_VIEW_DIR . $layout))
    {
      $view = $view . '/' . $this->DEFAULT_PAGE;
    }
    
    if (!file_exists(Application::$ROOT_VIEW_DIR . $this->addPrefix($view)) && is_dir(Application::$ROOT_VIEW_DIR . $view))
    {
      $view = $view . '/' . $this->DEFAULT_PAGE;
    }

    $layoutTemplate = $this->readTemplate($layout); 
    $pageTemplate = $this->readTemplate($view, $params);
    return preg_replace('/\{\{\s*content\s*\}\}/', $pageTemplate, $layoutTemplate);
  }
}
