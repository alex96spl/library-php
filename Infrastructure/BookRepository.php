<?php
require_once __DIR__ . '/../domain/Book.php';
require_once __DIR__ . '/../domain/BookStorage.php';

class BookRepository implements BookStorage
{
    private PDO $pdo;
    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }
    public function save(Book $book): void
    {
        $sql = 'INSERT INTO `Книги`(name_book,autor_book,date_of_publication) 
                VALUES(:name_book,:autor_book,:date_of_publication)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':name_book' => $book->get_name_book(),
            ':autor_book' => $book->get_autor_book(),
            ':date_of_publication' =>$book->get_date_of_publication()
    ]);
     }

     public function findByName(string $name_book): ?Book
    {
        $sql = 'SELECT * FROM `Книги` WHERE name_book = :name_book';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
        ':name_book' => $name_book
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row != null){
            return new Book ($row['id'],
                            $row['name_book'],
                            $row['autor_book'],
                            $row['date_of_publication']);
        }
            return null;
    }

    public function findById(int $id): ?Book
    {
        $sql = 'SELECT * FROM `Книги` WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
        ':id' => $id
        ]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row != null){
            return new Book ($row['id'],
                            $row['name_book'],
                            $row['autor_book'],
                            $row['date_of_publication']);
        }
            return null;
    }

    public function delete(Book $book): void
    {
        $sql = 'DELETE FROM `Книги` WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
        ':id' => $book->get_id_book()
        ]);
    }

    public function getAll(): array
    {
        $sql = 'SELECT * FROM `Книги`';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $books = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book(
                $row['id'],
                $row['name_book'],
                $row['autor_book'],
                $row['date_of_publication']
            );
        }

        return $books;
    }
}
?>