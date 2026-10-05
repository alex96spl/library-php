<?php
require_once __DIR__ . '/../domain/ReaderStorage.php';

class DeleteReader
{
	public function __construct(private ReaderStorage $readerStorage){}
	public function execute(int $id): void{
		$reader = $this->readerStorage->findById($id);
		if ($reader !== null){
			$this->readerStorage->delete($reader);
		}else{
			throw new InvalidArgumentException('Читатель не найден');
		}
	}
}



?>