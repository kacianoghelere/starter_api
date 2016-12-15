<?php

class TestController extends BaseController {

    function index($request, $response, $args) {
        $data = array("message" => "Test::index()");
        return $response->withJson($data);
    }
}