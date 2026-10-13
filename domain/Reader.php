<?php
namespace App\Domain;

class Reader   //класс читатель
{
    private $id; //идификатор читателя
    private $nameReader; // имя читателя
    private $surnameReader; // фамилия читателя
    private $phoneReader;  //телефон читателя
    public function __construct($id, $nameReader, $surnameReader, $phoneReader){  //автоматизируем
        $this->id = $id;
        $this->nameReader = $nameReader;
        $this->surnameReader = $surnameReader;
        $this->phoneReader = $phoneReader;
    }

    public function getReaderId()  //получим индификатор читателя
    {
        return $this->id;  //вернем индификатор читателя
    }

    public function getReaderName()  // получим имя читателя
    {
        return $this->nameReader;      //вернем имя читателя
    }

    public function getReaderSurname()   // получим фамилию читателя
    {
        return $this->surnameReader;       //вернем фамилию читателя
    }

    public function getReaderPhone()  //получим телефон читателя
    {
        return $this->phoneReader;    // вернем телефон читателя
    }
}
