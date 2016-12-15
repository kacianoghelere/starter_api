<?php

class HomeController extends BaseController {

    function index($request, $response, $args) {
        $data = array("message" => "Home::index()");
        return $response->withJson($data);
    }

    function hello($request, $response, $args) {
        $data = array("message" => "Hello, {$args['name']}");
        return $response->withJson($data);
    }
}