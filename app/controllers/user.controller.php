<?php

class UserController extends BaseController {

    function index($request, $response, $args) {
        $data = array("message" => "User::index()");
        $response = $response->withJson($data);
        return $response;
    }

    function find($request, $response, $args) {
        $data = array("message" => "User::find(id)", "args" => $args);
        $response = $response->withJson($data);
        return $response;
    }

    function create($request, $response, $args) {
        $data = array("message" => "User::create()");
        $response = $response->withJson($data);
        return $response;
    }

    function update($request, $response, $args) {
        $data = array("message" => "User::update(id)", "args" => $args);
        $response = $response->withJson($data);
        return $response;
    }

    function destroy($request, $response, $args) {
        $data = array("message" => "User::destroy(id)", "args" => $args);
        $response = $response->withJson($data);
        return $response;
    }
}