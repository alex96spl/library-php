<?php
namespace App\Infrastructure;
use App\Domain\Issuance;
use App\Domain\IssuanceStorage;
use PDO;


class IssuanceRepository implements IssuanceStorage
{
    private PDO $pdo;     // сохраняет выдачу
      public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }
    public function save(Issuance $issuance): void
    {
        $sql = 'INSERT INTO `Выдача`(book, reader, date_of_issue, return_period) 
                VALUES(:book, :reader, :date_of_issue, :return_period)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':book' => $issuance->getBook(),
            ':reader' => $issuance->getReader(),
            ':date_of_issue' =>$issuance->getDateOfIssue(),
            ':return_period' =>$issuance->getReturnPeriod()
    ]);
    }

     public function findById(int $id): ?Issuance   //ищет по айди
      {
        $sql = 'SELECT * FROM `Выдача` WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
        ':id' => $id
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row !== false){
            return new Issuance ($row['id'],
                            $row['book'],
                            $row['reader'],
                            $row['date_of_issue'],
                            $row['return_period'],
                            $row['return_date']
                        );
        }
            return null;
    }

    public function findBynamebooks(string $book): ?Issuance   //ищет по названию книги
      {
        $sql = 'SELECT * FROM `Выдача` WHERE book = :book AND return_date IS NULL';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
        ':book' => $book
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row !== false){
            return new Issuance ($row['id'],
                            $row['book'],
                            $row['reader'],
                            $row['date_of_issue'],
                            $row['return_period'],
                            $row['return_date']
                        );
        }
            return null;
    }

        public function findByName(string $book, string $reader): ?Issuance  //ищем по названию книги и по имени читателя
        {
        $sql = 'SELECT * FROM `Выдача` WHERE book = :book and reader = :reader  AND return_date IS NULL';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
        ':book' => $book,
        ':reader' => $reader
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row !== false){
            return new Issuance ($row['id'],
                            $row['book'],
                            $row['reader'],
                            $row['date_of_issue'],
                            $row['return_period'],
                            $row['return_date']
                        );
        }
        return null;
    }

         public function delete(Issuance $issuance): void  //удаляет выдачу
    {
        $sql = 'DELETE FROM `Выдача` WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
        ':id' => $issuance->getIssuanceId()
        ]);
    }

    public function update (Issuance $issuance): void //сохраняет дату возврата
    {
        $sql = 'UPDATE `Выдача`SET return_date = :return_date    /* найди книгу по названию с активной записью и запиши дату возврата*/
        WHERE book =:book AND return_date IS NULl AND reader = :reader'; //название книги и пустую дату(NULL) и читателя который держит эту книгу 
         $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':return_date' => $issuance->getReturnDate(),
            ':book' => $issuance->getBook(),
            ':reader' => $issuance->getReader()
           
    ]);

    }

    public function getAll(): array    // возвращаем список всех выдач
    {
        $sql = 'SELECT * FROM `Выдача`';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $issuances = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $issuances[] = new Issuance(
                $row['id'],
                $row['book'],
                $row['reader'],
                $row['date_of_issue'],
                $row['return_period'],
                $row['return_date']
            );
        }

        return $issuances;
    }

     }
?>