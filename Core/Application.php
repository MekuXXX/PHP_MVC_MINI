<?php

declare(strict_types=1);

namespace App\Core;
use App\Core\Router;
use App\Core\Request;

class Application
{
  public static string $ROOT_VIEW_DIR;
  public Router $router;
  protected Request $request;
  public function __construct(string $ROOT_VIEW_DIR = __DIR__ . '/../views/')
  {
    self::$ROOT_VIEW_DIR = $ROOT_VIEW_DIR;
    $this->router = new Router();
    $this->request = new Request();
  }

  public function run() {
    echo $this->router->resolve();
  }
}
