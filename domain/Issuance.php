<?php
namespace App\Domain;
use InvalidArgumentException;
/////////ВЫДАЧА/////////////
class Issuance    //класс выдача          1.
{
    private $idIssuance;    //айди выдачи
    private $book; // название книги
    private $reader; // имя читателя
    private string $dateOfIssue; // дата выдачи книиги
    private string $returnPeriod;       // срок возврата(дата возврата)
    private ?string $returnDate = null;   //дата возврата книги
        public function __construct($idIssuance, $book, $reader, $dateOfIssue, $returnPeriod, ?string $returnDate = null){

            if($returnPeriod < $dateOfIssue){        // Проверяем если дата возврата меньше даты получения
                throw new InvalidArgumentException('Срок возврата не может быть раньше даты выдачи.');          //throw  выбросить ошибку  new                                                                                                  InvalidArgumentException                                                                                            создать ошибку из-за неправильного аргумента
            } 
            $this->idIssuance = $idIssuance;  // ид читателя
            $this->book = $book;                // название книги
            $this->reader = $reader;           // имя читателя
            $this->dateOfIssue = $dateOfIssue;// дата выдачи книиги
            $this->returnPeriod = $returnPeriod;  // дата возврата(до какого числа нужно вернусть)
            $this->returnDate = $returnDate; // дата возрата книиги

            
    }

    public function getIssuanceId()  // айди
    {
        return $this->idIssuance;
    }

    public function returnBook(): bool   // вернуть книгу
    {
        if($this->HasItBeenReturned()){
            return false;
        }
        $this ->returnDate = date('Y-m-d');      //дата возврата год-месяц-день
        return true;
    }

    public function HasItBeenReturned(): bool   //возвращена ли книга?
    {
        return $this->returnDate !== null;
    }
    
    public function getBook()              // получить книгу
    {

        return $this->book;
    }

    public function getReader()       // получить читателя
    {
        return $this->reader;
    }
 
    public function getDateOfIssue()     // получить дату выдачи
    {
        return $this->dateOfIssue;
    }

    public function getReturnPeriod()    // получить срок возврата
    {
        return $this->returnPeriod;
    }

    public function getReturnDate(): ?string     // получить дату возврата
    {
        return $this->returnDate;
    }


}

?>
