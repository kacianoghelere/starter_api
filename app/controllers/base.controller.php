<?php

require_once('app/core/connection.config.php');

/**
 * 
 */
abstract class BaseController {

    protected $connection;

    /**
     * Construtor da instancia
     */
    public function __construct() {
        $this->connection = Connection::getInstance();
    }

    public function dispatch($request, $response, $args) {
        
    }
}