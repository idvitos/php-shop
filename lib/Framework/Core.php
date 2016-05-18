<?php

namespace Framework;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class Core implements HttpKernelInterface {

  protected $routes = array();

  public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true) {

    $path = $request->getPathInfo();

    if (array_key_exists($path, $this->routes)) {
      $controller = $this->routes[$path];
      $response = $controller();
    }
    else {
      $response = new Response('Not found!', Response::HTTP_NOT_FOUND);
    }

    return $response;
  }

  public function map($path, $controller) {
    $this->routes[$path] = $controller;
  }

}
