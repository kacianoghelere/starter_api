<?php

require_once("database.config.php");

/**
 * Conexão com o banco de dados
 */
class Connection extends PDO {

    private static $instance;

    /**
     * Construtor da instancia
     */
    public function __construct() {
        $conf = Database::getConfiguration();
        $dsn = "mysql:host={$conf['host']};dbname={$conf['database']};";
        parent::__construct($dsn, $conf['user'], $conf['passwd'],
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    }

    /**
     * Retorna instancia singleton da conexão como BD
     * @return Connection Instancia da conexão
     */
    public static function getInstance() {
        try {
            if (!isset(self::$instance)) {
                $conn = new Connection();
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance = $conn;
                return $conn;
            }
            return self::$instance;
        } catch (PDOException $exc) {
            $error = "[".__FUNCTION__."] -- {$exc->getMessage()}";
            self::printError($error, false);
        }
    }

    /**
     * Executa sql (INSERT, UPDATE, DELETE)
     * @param  ??????  $stmt         Statement do PDO
     * @param  boolean $displayError Mostrar erros
     * @return [type]                [description]
     */
    public static function executeSql($stmt, $displayError = true) {
        try {
            $result = $stmt->execute();
            return $result;
        } catch (Exception $exc) {
            $error = "[".__FUNCTION__."] "
                . "-- {$stmt->queryString} "
                . "-- {$exc->getMessage()}";
            self::printError($error);
        }
    }

    /**
     * Executa sql  (INSERT, UPDATE, DELETE) com retorno de registro único em 
     * forma de vetor (RETURNING)
     * @param  ??????  $stmt         Statement do PDO
     * @param  ??????  $fetchmode    Modo de retorno dos dados
     * @param  ??????  $entity       Classe da entidade
     * @param  boolean $displayError Mostrar erros
     * @return [type]                [description]
     */
    public static function executeSqlFetch($stmt, 
            $fetchmode = PDO::FETCH_ASSOC, $entity = null, $displayError = true) {
        try {
            $stmt->execute();
            if ($fetchmode == PDO::FETCH_CLASS && $entity != null) {
                $stmt->setFetchMode($fetchmode, $entity);
            } else {
                $stmt->setFetchMode($fetchmode);
            }
            $result = $stmt->fetch();
            return $result;
        } catch (Exception $exc) {
            $error = "[".__FUNCTION__."] "
                . "-- {$stmt->queryString} "
                . "-- {$exc->getMessage()}";
            self::printError($error);
        }
    }

    /**
     * Busca registro único em forma de vetor
     * @param  ??????  $stmt         Statement do PDO
     * @param  ??????  $fetchmode    Modo de retorno dos dados
     * @param  ??????  $entity       Classe da entidade
     * @param  boolean $displayError Mostrar erros
     * @return [type]                [description]
     */
    public static function executeFetch($stmt, 
            $fetchmode = PDO::FETCH_ASSOC, $entity = null, $displayError = true) {
        try {
            $stmt->execute();
            if ($fetchmode == PDO::FETCH_CLASS && $entity != null) {
                $stmt->setFetchMode($fetchmode, $entity);
            } else {
                $stmt->setFetchMode($fetchmode);
            }
            $result = $stmt->fetch();
            return $result;
        } catch (Exception $exc) {
            $error = "[".__FUNCTION__."] "
                . "-- {$stmt->queryString} "
                . "-- {$exc->getMessage()}";
            self::printError($error);
        }
    }

    /**
     * Busca vários registros em forma de matriz
     * @param  ??????  $stmt         Statement do PDO
     * @param  ??????  $fetchmode    Modo de retorno dos dados
     * @param  ??????  $entity       Classe da entidade
     * @param  boolean $displayError Mostrar erros
     * @return [type]                [description]
     */
    public static function executeFetchAll($stmt, $fetchmode = PDO::FETCH_ASSOC,
            $entity = null, $displayError = true) {
        try {
            $stmt->execute();
            if ($fetchmode == PDO::FETCH_CLASS && $entity != null) {
                $stmt->setFetchMode($fetchmode, $entity);
            } else {
                $stmt->setFetchMode($fetchmode);
            }
            $result = $stmt->fetchAll();
            return $result;
        } catch (Exception $exc) {
            $error = "[".__FUNCTION__."] "
                . "-- {$stmt->queryString} "
                . "-- {$exc->getMessage()}";
            self::printError($error);
        }
    }

    /**
     * Imprime o erro
     * @param string  $error   Descrição do erro
     * @param boolean $display Flag de mostrar o erro
     */
    private static function printError($error, $display = true) {
        if ($display) {
           throw new Exception($error);
        } else {
            error_log("SYSTEM ERROR : {$error}");
        }
    }
}