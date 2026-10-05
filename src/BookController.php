<?php

require_once __DIR__ . '/../Infrastructure/database.php';
require_once __DIR__ . '/../Infrastructure/BookRepository.php';
require_once __DIR__ . '/../application/DeleteBook.php';

class BookController
{
    private $bookRepository;
    private $deleteBook;

    public function __construct()
    {
        $pdo = connectDB();
        $this->bookRepository = new BookRepository($pdo);
        $this->deleteBook = new DeleteBook($this->bookRepository);
    }

    public function index(array $params): void // получить все книги
    {
        $books = $this->bookRepository->getAll();

        include __DIR__ . '/../views/books/index.html';  //подключить страницу
    }

    public function show(array $params): void  //получить одну книгу(по айди)
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

        include __DIR__ . '/../views/books/show.html';   //подключить страницу
    }

    public function create(array $params): void // добавление новой книги
    {
        if(isset($params['name']) && isset($params['author']) && isset($params['year'])){  // проверка (пришли-ли данные  с формы)
            $book = new Book(null,$params['name'],$params['author'],$params['year']);  //создаем новую книгу
            $this->bookRepository->save($book); //сохраняем в бд
        }
        include __DIR__ . '/../views/books/create.html'; //подключить страницу
    }

    public function delete(array $params) :void // удаление книги
    {
        $id = $params['id'] ?? null;
        if ($id !== null){
            $this->deleteBook->execute($id);
            header('Location: /books'); //возврат обратно к списку книг
            exit;
        }
    }

}
