<?php
/////////ВЫДАЧА/////////////
class Issuance    //класс выдача          1.
{
    private $id_issuance;    //айди выдачи
    private $book; // название книги
    private $reader; // имя читателя
    private string $date_of_issue; // дата выдачи книиги
    private string $return_period;       // срок возврата(дата возврата)
    private ?string $return_date = null;   //дата возврата книги
        public function __construct($id_issuance, $book, $reader, $date_of_issue, $return_period, ?string $return_date = null){

            if($return_period < $date_of_issue){        // Проверяем если дата возврата меньше даты получения
                throw new InvalidArgumentException('Срок возврата не может быть раньше даты выдачи.');          //throw  выбросить ошибку  new                                                                                                  InvalidArgumentException                                                                                            создать ошибку из-за неправильного аргумента
            } 
            $this->id_issuance = $id_issuance;  // ид читателя
            $this->book = $book;                // название книги
            $this->reader = $reader;           // имя читателя
            $this->date_of_issue = $date_of_issue;// дата выдачи книиги
            $this->return_period = $return_period;  // дата возврата(до какого числа нужно вернусть)
            $this->return_date = $return_date; // дата возрата книиги

            
    }

    public function get_id_issuance()  // айди
    {
        return $this->id_issuance;
    }

    public function return_book(): bool   // вернуть книгу
    {
        if($this->Has_it_been_returned()){
            return false;
        }
        $this ->return_date = date('Y-m-d');      //дата возврата год-месяц-день
        return true;
    }

    public function Has_it_been_returned(): bool   //возвращена ли книга?
    {
        return $this->return_date !== null;
    }
    
    public function get_book()              // получить книгу
    {

        return $this->book;
    }

    public function get_reader()       // получить читателя
    {
        return $this->reader;
    }
 
    public function get_date_of_issue()     // получить дату выдачи
    {
        return $this->date_of_issue;
    }

    public function get_return_period()    // получить срок возврата
    {
        return $this->return_period;
    }

    public function get_return_date(): ?string     // получить дату возврата
    {
        return $this->return_date;
    }


}

?>
