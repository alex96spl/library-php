<?php
require_once __DIR__ . '/../Infrastructure/database.php';
require_once __DIR__ . '/../Infrastructure/IssuanceRepository.php';
require_once __DIR__ . '/../Infrastructure/BookRepository.php';
require_once __DIR__ . '/../Infrastructure/ReaderRepository.php';
require_once __DIR__ . '/../application/IssueBook.php';

class IssuanceController
{
    private $issuanceRepository;
    private $bookRepository;
    private $readerRepository;
    private $issueBook;

    
     public function __construct()
    {
        $pdo = connectDB();
        $this->issuanceRepository = new IssuanceRepository($pdo);
        $this->bookRepository = new BookRepository($pdo);
        $this->readerRepository = new ReaderRepository($pdo);
        $this->issueBook = new IssueBook($this->bookRepository, $this->readerRepository,$this->issuanceRepository);
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
}
