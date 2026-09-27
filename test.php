<?php
require_once __DIR__ . '/Infrastructure/database.php';
require_once __DIR__ . '/Infrastructure/BookRepository.php';
require_once __DIR__ . '/Infrastructure/ReaderRepository.php';
require_once __DIR__ . '/Infrastructure/IssuanceRepository.php';
require_once __DIR__ . '/application/IssueBook.php';

$pdo = connectDB();
$bookRepository = new BookRepository($pdo);
$readerRepository = new ReaderRepository($pdo);
$issuanceRepository = new IssuanceRepository($pdo);
$issueBook = new IssueBook($bookRepository, $readerRepository, $issuanceRepository);

$issueBook->execute('Мастер и Маргарита','Артур','2026-09-30');
?>
