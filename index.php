<?php

require_once __DIR__ . '/vendor/autoload.php';

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);

$api_host = "https://fuel-delivery.jerit.in";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri === '/api-admin') {
  header('Location: '.$api_host.'/admin');
  exit();
}


switch (true) {
  case $uri === '/':
    echo $twig->render('pages/index.html.twig', ['api_host' => $api_host]);
    break;
  case $uri === '/login':
    echo $twig->render('pages/login.html.twig', ['api_host' => $api_host]);
    break;
  case $uri === '/register':
    echo $twig->render('pages/signup.html.twig', ['api_host' => $api_host]);
    break;
  case $uri === '/order':
    echo $twig->render('pages/order.html.twig', ['api_host' => $api_host]);
    break;
  case $uri === '/admin':
    echo $twig->render('pages/admin.html.twig', ['api_host' => $api_host]);
    break;
  case $uri === '/orders':
    echo $twig->render('pages/orders.html.twig', ['api_host' => $api_host]);
    break;
  case preg_match('/^\/order\/success\/\d+$/', $uri,):
    echo $twig->render('pages/after_order.html.twig', ['api_host' => $api_host]);
    break;
  default:
    http_response_code(404);
    echo "Page Not Found";
    exit();
}
