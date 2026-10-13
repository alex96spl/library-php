<?php
namespace App\Controller;
use App\Infrastructure\IssuanceRepository;
use App\Infrastructure\BookRepository;
use App\Infrastructure\ReaderRepository;
use App\Application\IssueBook;
use App\Infrastructure\Database;
use App\Application\ReturnBook;


class IssuanceController
{
    private $issuanceRepository;
    private $bookRepository;
    private $readerRepository;
    private $issueBook;
    private $returnBook;

    
     public function __construct()
    {
        $pdo = Database::connect();
        $this->issuanceRepository = new IssuanceRepository($pdo);
        $this->bookRepository = new BookRepository($pdo);
        $this->readerRepository = new ReaderRepository($pdo);
        $this->issueBook = new IssueBook($this->bookRepository, $this->readerRepository,$this->issuanceRepository);
        $this->returnBook = new ReturnBook($this->issuanceRepository);
    }
    public function index(array $params): void // получить список выдач 
    {
        $issuances = $this->issuanceRepository->getAll();

        include __DIR__ . '/../views/issuances/index.html';  //подключить страницу
    }
    public function show(array $params): void  //получить дитали конкретной выдачи
    {
        $id = $params['id'] ?? null;

        if (!$id) {
            echo 'ID выдачи не указан';
            return;
        }

        $issuance = $this->issuanceRepository->findById($id);

        if (!$issuance) {
            echo 'Выдача не найден';
            return;
        }

        include __DIR__ . '/../views/issuances/show.html';   //подключить страницу
    }
    public function create(array $params): void // добавление новой выдачи
    {
        if(isset($params['name']) && isset($params['reader']) && isset($params['returnDeadline'])){
        $this->issueBook->execute($params['name'],$params['reader'],$params['returnDeadline']);
        }

        include __DIR__ . '/../views/issuances/create.html';
    }

    public function returnBook(array $params): void //вернуть книгу
    {
        $bookName = $params['bookName'] ?? null;
        $readerName = $params['readerName'] ?? null;
        if ($bookName !== null && $readerName !== null){
            $this->returnBook->execute($bookName, $readerName);
            header('Location: /issuances'); //возврат обратно к списку выдач.
         exit;
        }
    }
}
