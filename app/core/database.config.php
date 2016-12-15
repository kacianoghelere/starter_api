<?php

/**
 * Configurações da conexão com o banco de dados
 */
class Database {

    private static $conf = array(
        'host'     => '127.0.0.1',
        'user'     => 'root',
        'passwd'   => 'd0v4hk11n',
        'port'     => '3306',
        'database' => 'teste',
        'charset'  => 'utf8'
    );

    /**
     * Retorna configurações de conexão
     * @return array Configurações de conexão
     */
    public static function getConfiguration() {
        return self::$conf;
    }
}