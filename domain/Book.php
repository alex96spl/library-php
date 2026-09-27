<?php 
class Book       //класс книга
{
    private $id_book; //айди книги
    private $name_book; // Название  книги
    private $autor_book; // автор книги
    private $date_of_publication; // дата издания
    public function __construct($id_book,$name_book, $autor_book, $date_of_publication){   //автоматизируем

        $this->id_book = $id_book;
        $this->name_book = $name_book;
        $this->autor_book = $autor_book;
        $this->date_of_publication = $date_of_publication;
    }
    public function get_id_book(){   ////получим индификатор читателя
        return $this->id_book;
    }

    public function get_name_book(){   // получим Название  книги
        return $this->name_book;
    }

    public function get_autor_book(){  // получим автора  книги
        return $this->autor_book;
    }

    public function get_date_of_publication(){  // получим год издания  книги
        return $this->date_of_publication;
    }
} 
?>