<?php

class UserController extends BaseController {

    function index($request, $response, $args) {
        $data = array("message" => "User::index()");
        return $response->withJson($data);
    }

    function find($request, $response, $args) {
        $data = array("message" => "User::find(id)", "args" => $args);
        return $response->withJson($data);
    }

    function create($request, $response, $args) {
        $data = array("message" => "User::create()");
        return $response->withJson($data);
    }

    function update($request, $response, $args) {
        $data = array("message" => "User::update(id)", "args" => $args);
        return $response->withJson($data);
    }

    function destroy($request, $response, $args) {
        $data = array("message" => "User::destroy(id)", "args" => $args);
        return $response->withJson($data);
    }
}