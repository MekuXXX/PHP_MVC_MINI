<?php

declare(strict_types=1);
namespace App\Core;

class View
{

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

  public function renderView(string $view, array $params = []): string
  {
    $layout = $this->readTemplate($this->addPrefix('layout')); 
    $page = $this->readTemplate($this->addPrefix($view), $params);
    return preg_replace('/\{\{\s*content\s*\}\}/', $page, $layout);
  }
}
