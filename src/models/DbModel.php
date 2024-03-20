<?php
abstract Class Db{
    private static $instance;

    protected static function getInstance()
    {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO("mysql:host=127.0.0.1;dbname=social_network", "root", "");
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $error) {
                die ($error->getMessage());
            }
        }
        return self::$instance;
    }

    protected static function disconnect()
    {
        self::$instance = null;
    }
}