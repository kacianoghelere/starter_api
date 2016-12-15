<?php

class UserController extends BaseController {

    function index($request, $response, $args) {
        $sql = "SELECT * FROM users;";
        $stmt = $this->connection->prepare($sql);
        $data = $this->connection->executeFetchAll($stmt);
        return $response->withJson($data);
    }

    function find($request, $response, $args) {
        $sql = "SELECT * FROM users WHERE user_id = :user_id;";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":user_id", $args['id'], PDO::PARAM_INT);
        $data = $this->connection->executeFetchAll($stmt);
        return $response->withJson($data);
    }

    function create($request, $response, $args) {
        $params = $request->getParsedBody();

        $sql = "INSERT INTO users (name, password) VALUES (?, ?);";
        $stmt = $this->connection->prepare($sql);
        $i = 1;
        $stmt->bindParam($i++, $params['name'], PDO::PARAM_STR);
        $stmt->bindParam($i++, $params['password'], PDO::PARAM_STR);
        $this->connection->executeSql($stmt);

        $data = array("id" => $this->connection->lastInsertId());
        return $response->withJson($data);
    }

    function update($request, $response, $args) {
        $params = $request->getParsedBody();

        $sql = "UPDATE users SET 
                name = :name,
                password = :password
            WHERE user_id = :user_id;";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":name", $params['name'], PDO::PARAM_STR);
        $stmt->bindParam(":password", $params['password'], PDO::PARAM_STR);
        $stmt->bindParam(":user_id", $args['id'], PDO::PARAM_INT);
        $this->connection->executeSql($stmt);

        $data = array("id" => $args['id']);
        return $response->withJson($data);
    }

    function destroy($request, $response, $args) {
        $data = array("message" => "User::destroy(id)", "args" => $args);
        return $response->withJson($data);
    }
}