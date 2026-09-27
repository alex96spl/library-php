<?php

class Reader   //класс читатель
{
    private $id; //идификатор читателя
    private $name_reader; // имя читателя
    private $surname_reader; // фамилия читателя
    private $phone_reader;  //телефон читателя
    public function __construct($id, $name_reader, $surname_reader, $phone_reader){  //автоматизируем
        $this->id = $id;
        $this->name_reader = $name_reader;
        $this->surname_reader = $surname_reader;
        $this->phone_reader = $phone_reader;
    }

    public function get_id_reader(){  //получим индификатор читателя
        return $this->id;  //вернем индификатор читателя
    }

    public function get_name_reader(){ // получим имя читателя
        return $this->name_reader;      //вернем имя читателя
    }

    public function get_surname_reader(){  // получим фамилию читателя
        return $this->surname_reader;       //вернем фамилию читателя
    }

    public function get_phone_reader() { //получим телефон читателя
        return $this->phone_reader;    // вернем телефон читателя
    }
}

?>