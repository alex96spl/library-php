<?php
require_once __DIR__ . '/../domain/IssuanceStorage.php';

class ReturnBook  // сервисный слой(возврат книги)
{
	public function __construct(private IssuanceStorage $issuance){}
    public function execute(string $bookName, string $readerName): void{

       $issuance = $this->issuance->findByName($bookName, $readerName);

        if ($issuance !== null){ //проверка нашли активную выдачу?
    $issuance->return_book();  //если нашли меняем дату

    $this->issuance->update($issuance);  //записываем в бд

    echo 'Книга возвращена: ' . $issuance->get_return_date();

} else {
    echo 'Активная выдача не найдена';//если не нашли
}
    }
}
?>