<?php 
namespace App\Infrastructure;
use PDO;
class Database
{
    public static function connect(): PDO{
        return new PDO(
            'mysql:host=MySQL-8.0;dbname=library;charset=utf8mb4',
            'root',
            ''
        );
    }
}
?>