<?php
require_once __DIR__ . '/Reader.php';
interface ReaderStorage //интерфейс
{
    public function save(Reader $reader): void; // сохраняет читателя

    public function findById(int $id): ?Reader; // ищет читателя по айди

    public function findByName(string $name_reader): ?Reader; // ищет читателя по имени

    public function delete(Reader $reader): void;  //удаляет читателя
}
?>