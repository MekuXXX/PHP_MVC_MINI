<?php 

require_once __DIR__ . '/../vendor/autoload.php';
use App\Core\Application;

$app = new Application();


$app->router->get("/", function (){
  return "Hello world";
});

$app->router->get('/contact', 'contact');
$app->router->get('/fun', 'fun');


$app->run();