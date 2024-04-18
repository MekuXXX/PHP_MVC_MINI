<?php

declare(strict_types=1);
namespace App\Core;

use App\Core\Request;
use App\Core\Application;

class Router
{
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
    $callback = $this->routes[$method][$path] ?? 'errors/404NotFound
    ';
    
    if (is_callable($callback)) 
    {
      return call_user_func($callback);
    }

    return $this->renderView($callback);
  }

  protected function addPrefix(string $view) 
  {
    return str_contains($view, '.php') ? $view : "$view.php";
  }

  
  protected function layoutContent(string $view) 
  {
    ob_start();
    include_once Application::$ROOT_VIEW_DIR . $this->addPrefix($view);
    return ob_get_clean();
  }

  protected function renderView(string $view) 
  {
    include_once Application::$ROOT_VIEW_DIR . $this->addPrefix($view);
  }

  public function get(string $path, callable | string $callback) 
  {
    $this->routes['get'][$path] = $callback;
  }
}
