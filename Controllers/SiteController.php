<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;

class SiteController extends Controller
{

  public function home()
  { 
    $params = [
      'name' => "Mayushi"
    ];

    return $this->render('home', $params);
  }

  public static function handleContact(Request $request)
  {
    $body = $request->getBody();
    var_dump($body);
    return "Handle from controller";
  }
}
