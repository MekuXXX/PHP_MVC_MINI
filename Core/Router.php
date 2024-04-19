<?php

declare(strict_types=1);
namespace App\Core;

use App\Core\Request;
use App\Core\Application;

class Router
{
  public string $notFound = 'errors/404NotFound';
  protected array $routes = [];
  protected Request $request;

  public function __construct() 
  {  
    $this->request = new Request();
  }

  public function resolve() 
  {
    $method = $this->request->getMethod();
    $path = $this->request->getPath();
    $callback = $this->routes[$method][$path] ?? $this->notFound;
    
    if (is_callable($callback)) 
    {
      return call_user_func($callback);
    }

    return $this->renderView(trim($callback));
  }

  protected function addPrefix(string $view) 
  {
    return str_contains($view, '.php') ? $view : "$view.php";
  }

  
  protected function readTemplate(string $view): string
  {
    ob_start();
    include_once Application::$ROOT_VIEW_DIR . $this->addPrefix($view);
    return ob_get_clean();
  }

  protected function renderView(string $view) 
  {
    if ($this->notFound === $view)
    {
      Application::$app->response->setStatusCode(404);
    }
    
    $layout = $this->readTemplate($this->addPrefix('layout')); 
    $page = $this->readTemplate($this->addPrefix($view));
    return str_replace("{{ content }}", $page, $layout);
  }

  public function get(string $path, callable | string $callback) 
  {
    $this->routes['get'][$path] = $callback;
  }
}
