<?php
require_once __DIR__ . '/../domain/Reader.php';
require_once __DIR__ . '/../domain/ReaderStorage.php';

class ReaderRepository implements ReaderStorage
{
    private PDO $pdo;
      public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }
    public function save(Reader $reader): void
    {
        $sql = 'INSERT INTO `Читатели`(name_reader, surname_reader, phone_reader) 
                VALUES(:name_reader,:surname_reader,:phone_reader)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name_reader' => $reader->get_name_reader(),
            ':surname_reader' => $reader->get_surname_reader(),
            ':phone_reader' =>$reader->get_phone_reader()
    ]);
     }

     public function findByName(string $name_reader): ?Reader  //поиск по имени
    {
        $sql = 'SELECT * FROM `Читатели` WHERE name_reader = :name_reader';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
        ':name_reader' => $name_reader
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row != null){
            return new Reader ($row['id'],
                            $row['name_reader'],
                            $row['surname_reader'],
                            $row['phone_reader']);
        }
            return null;
    }

     public function findById(int $id): ?Reader
      {
        $sql = 'SELECT * FROM `Читатели` WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
        ':id' => $id
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row != null){
            return new Reader ($row['id'],
                            $row['name_reader'],
                            $row['surname_reader'],
                            $row['phone_reader']);
        }
            return null;
    }

     public function delete(Reader $reader): void
    {
        $sql = 'DELETE FROM `Читатели` WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
        ':id' => $reader->get_id_reader()
        ]);
    }
}
?>