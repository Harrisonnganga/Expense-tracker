<?php
// config/DB.php - Simple database helper

class DB {
    private static $connection = null;
    
    public static function connect() {
        if (self::$connection === null) {
            // Direct DDEV MySQL configuration
            self::$connection = new mysqli('db', 'db', 'db', 'db');
            
            if (self::$connection->connect_error) {
                die("Database connection failed: " . self::$connection->connect_error);
            }
            
            self::$connection->set_charset('utf8mb4');
        }
        return self::$connection;
    }
    
    public static function query($sql) {
        $result = self::connect()->query($sql);
        if (!$result) {
            error_log("DB Query Error: " . self::connect()->error);
        }
        return $result;
    }
    
    public static function escape($value) {
        return self::connect()->real_escape_string($value);
    }
    
    public static function getError() {
        return self::connect()->error;
    }
    
    public static function fetchAll($sql) {
        $result = self::query($sql);
        $rows = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            $result->free();
        }
        return $rows;
    }
}
