<?php

class HomeController extends BaseController {

    function index($request, $response, $args) {
        $data = array("message" => "Home::index()");
        return $response->withJson($data);
    }

    function hello($request, $response, $args) {
        $file = file_get_contents('routes.json');
        $data = json_decode($file);
        return $response->withJson($data);
    }
}