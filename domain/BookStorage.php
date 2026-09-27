<?php
require_once __DIR__ . '/Book.php';
interface BookStorage //интерфейс
{
    public function save(Book $book): void; // сохраняет книгу

    public function findById(int $id): ?Book; // ищет книгу

    public function findByName(string $name_book): ?Book; // ищет книгу

    public function delete(Book $book): void;  //удаляет книгу

    public function getAll(): array; // получает все книги

}
?>
