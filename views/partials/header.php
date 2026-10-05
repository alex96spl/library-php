  <style>
  .action-button {
        display: inline-block;
        margin: 10px 0 20px;
        padding: 10px 16px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-weight: bold;
        }   

        .action-button:hover {
        background-color: #007bff;
        }
        .main-menu {
        max-width: 1000px;
        margin: 20px auto;
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        } 
    </style>

<nav class="main-menu">
    <a class="action-button" href="/">Главная</a>
    <a class="action-button" href="/books">Список книг</a>
    <a class="action-button" href="/readers">Список читателей</a>
    <a class="action-button" href="/issuances">Список выдач</a>
    <a class="action-button" href="/books/create">Добавить книгу</a>
    <a class="action-button" href="/readers/create">Добавить читателя</a>
    <a class="action-button" href="/issuances/create">Сделать выдачу книги</a>
</nav>