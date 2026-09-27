<?php

require_once __DIR__ . '/../Infrastructure/database.php';
require_once __DIR__ . '/../Infrastructure/BookRepository.php';

class BookController
{
    private $bookRepository;

    public function __construct()
    {
        $pdo = connectDB();
        $this->bookRepository = new BookRepository($pdo);
    }

    public function index(array $params): void
    {
        $books = $this->bookRepository->getAll();

        include __DIR__ . '/../views/books/index.html';
    }

    public function show(array $params): void
    {
        $id = $params['id'] ?? null;

        if (!$id) {
            echo 'ID книги не указан';
            return;
        }

        $book = $this->bookRepository->findById($id);

        if (!$book) {
            echo 'Книга не найдена';
            return;
        }

        include __DIR__ . '/../views/books/show.html';
    }
}
