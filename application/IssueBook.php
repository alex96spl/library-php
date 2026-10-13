<?php
namespace App\Application;
use App\Domain\BookStorage;
use App\Domain\ReaderStorage;
use App\Domain\IssuanceStorage;
use App\Domain\Issuance;
use InvalidArgumentException;
class IssueBook  // сервисный слой(выдача книги)
{
   public function __construct(private BookStorage $book,private ReaderStorage $reader,private IssuanceStorage $issuance){}

    public function execute(string $bookName,string $readerName,string $return_period): void{
        $book = $this->book->findByName($bookName);
        $reader = $this->reader->findByName($readerName);
        if ($book !== null && $reader !== null) {

    // Проверяем, занята ли сейчас книга
    $activeIssuance = $this->issuance->findBynamebooks(
        $book->getBookName()
    );
       if ($activeIssuance !== null) {

        throw new InvalidArgumentException('Книгу выдать нельзя. Она находится у читателя:'. $activeIssuance->getReader());


    } else {

        $issuance = new Issuance(
            null,
            $book->getBookName(),
            $reader->getReaderName(),
            date('Y-m-d'),
            $return_period
        );

        $this->issuance->save($issuance);
    }
    } else {
    throw new InvalidArgumentException('Книга или читатель не найдены');
}
    }
}
?>