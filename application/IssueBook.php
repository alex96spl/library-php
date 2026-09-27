<?php
require_once __DIR__ . '/../domain/BookStorage.php';
require_once __DIR__ . '/../domain/ReaderStorage.php';
require_once __DIR__ . '/../domain/IssuanceStorage.php';
require_once __DIR__ . '/../domain/Issuance.php';
class IssueBook  // сервисный слой(выдача книги)
{
   public function __construct(private BookStorage $book,private ReaderStorage $reader,private IssuanceStorage $issuance){}

    public function execute(string $bookName,string $readerName,string $return_period): void{
        $book = $this->book->findByName($bookName);
        $reader = $this->reader->findByName($readerName);
        if ($book !== null && $reader !== null) {

    // Проверяем, занята ли сейчас книга
    $activeIssuance = $this->issuance->findBynamebooks(
        $book->get_name_book()
    );
       if ($activeIssuance !== null) {

        echo 'Книгу выдать нельзя. Она находится у читателя: '
            . $activeIssuance->get_reader();

    } else {

        $issuance = new Issuance(
            null,
            $book->get_name_book(),
            $reader->get_name_reader(),
            date('Y-m-d'),
            $return_period
        );

        $this->issuance->save($issuance);
            echo 'Книга выдана';
    }
} else {
    echo 'Ошибка: книга или читатель не найдены';
}
    }
}
?>