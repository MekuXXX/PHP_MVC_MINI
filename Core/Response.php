<?php

namespace App\Core;

class Response
{
 
  
  public function setStatusCode(int $statusCode)
  {
    http_response_code($statusCode);
  }
}
