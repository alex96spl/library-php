<?php
namespace App\Application;
use App\Domain\BookStorage;

class DeleteBook // сервисный слой удаление книги
{
public function __construct(private BookStorage $bookStorage){}
	public function execute(int $id): void{
		$book = $this->bookStorage->findById($id);
		if ($book !== null){
			$this->bookStorage->delete($book); //удаляем
		}else {
			throw new InvalidArgumentException('Книга не найдена');
		}
	}
}

?>