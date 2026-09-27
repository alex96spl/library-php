<?php 
function connectDB() {
    return new PDO(
        'mysql:host=MySQL-8.0;dbname=library;charset=utf8mb4',
        'root',
        ''
    );
}
?>