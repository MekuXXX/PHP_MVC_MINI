<?php
declare(strict_types=1);
namespace App\Core;

class Request
{

  public function getPath(): string 
  {
    $path = $_SERVER['REQUEST_URI'] ?? '/';
    return explode('?', $path)[0];
  }

  public function getMethod(): string 
  {
    return strtolower($_SERVER['REQUEST_METHOD']) ?? 'get';
  }
}
