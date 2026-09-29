<?php
require_once __DIR__ . '/Issuance.php';

interface IssuanceStorage //интерфейс
{
    public function save(Issuance $issuance): void; // сохраняет выдачу

    public function findById(int $id): ?Issuance; // ищет выдачу

    public function findBynamebooks(string $book): ?Issuance; //ищет по названию книги 

    public function findByName(string $book, string $reader): ?Issuance; //ищет выдачу по названию книги и читателю

    public function delete(Issuance $issuance): void;  //удаляет выдачу

    public function update (Issuance $issuance): void; // сохраняет дату возврата

    public function getAll(): array; //возвращает  список все выдачи


}
?>