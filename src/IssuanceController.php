<?php
require_once __DIR__ . '/../Infrastructure/database.php';
require_once __DIR__ . '/../Infrastructure/IssuanceRepository.php';

class IssuanceController
{
    private $issuanceRepository;
     public function __construct()
    {
        $pdo = connectDB();
        $this->issuanceRepository = new IssuanceRepository($pdo);
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
}
