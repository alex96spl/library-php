<?php
namespace App\Application;
use App\Domain\IssuanceStorage;
use InvalidArgumentException;

class ReturnBook  // сервисный слой(возврат книги)
{
	public function __construct(private IssuanceStorage $issuance){}
    public function execute(string $bookName, string $readerName): void{

       $issuance = $this->issuance->findByName($bookName, $readerName);

        if ($issuance !== null){ //проверка нашли активную выдачу?
    $issuance->returnBook();  //если нашли меняем дату

    $this->issuance->update($issuance);  //записываем в бд

    $issuance->getReturnDate();

} else {
    throw new InvalidArgumentException('Активная выдача не найдена');//если не нашли
}
    }
}
?>