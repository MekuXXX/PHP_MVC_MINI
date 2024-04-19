<?php

declare(strict_types=1);

namespace App\Core;
use App\Core\Router;
use App\Core\Request;
use App\Core\Response;

class Application
{
  public static string $ROOT_VIEW_DIR;
  public static Application $app;
  public Response $response;
  public Router $router;
  protected Request $request;

  public function __construct(string $ROOT_VIEW_DIR = __DIR__ . '/../views/')
  {
    self::$ROOT_VIEW_DIR = $ROOT_VIEW_DIR;
    self::$app = $this;
    $this->router = new Router();
    $this->request = new Request();
    $this->response = new Response();
  }

  public function run() {
    echo $this->router->resolve();
  }
}
