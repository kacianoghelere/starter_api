<?php

class HomeController extends BaseController {

    function index($request, $response, $args) {
        $data = array("message" => "Home::index()");
        $response = $response->withJson($data);
        return $response;
    }

    function hello($request, $response, $args) {
        $file = file_get_contents('routes.json');
        $data = json_decode($file);
        $response = $response->withJson($data);
        return $response;
    }
}