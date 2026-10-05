<?php
require_once __DIR__ . '/../Infrastructure/database.php';
require_once __DIR__ . '/../Infrastructure/ReaderRepository.php';
require_once __DIR__ . '/../application/DeleteReader.php';

class ReaderController
{
    private $readerRepository;
    private $deleteReader;
    public function __construct()
    {
        $pdo = connectDB();
        $this->readerRepository = new ReaderRepository($pdo);
        $this->deleteReader = new deleteReader($this->readerRepository);
    }

    public function index(array $params): void // получить всех читателей
    {
        $readers = $this->readerRepository->getAll();

        include __DIR__ . '/../views/readers/index.html';  //подключить страницу
    }

    public function show(array $params): void  //получить одного читателя(по айди)
    {
        $id = $params['id'] ?? null;

        if (!$id) {
            echo 'ID читателя не указан';
            return;
        }

        $reader = $this->readerRepository->findById($id);

        if (!$reader) {
            echo 'Читатель не найден';
            return;
        }

        include __DIR__ . '/../views/readers/show.html';   //подключить страницу
    }
    public function create(array $params): void   // добавить нового читателя
    {
        if (isset($params['name'])&& isset($params['surname']) && isset($params['phone'])){
            $reader = new Reader(null, $params['name'], $params['surname'], $params['phone']);
            $this->readerRepository->save($reader);
        }
        include __DIR__ . '/../views/readers/create.html';
    }

        public function delete(array $params) :void // удаление читателя
        {
            $id = $params['id'] ?? null;
            if($id !== null){
                $this->deleteReader->execute($id);
                header('Location: /readers'); //возврат обратно к списку читателей
                exit;

            }
        }
}
