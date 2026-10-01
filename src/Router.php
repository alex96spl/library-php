<?php

require_once __DIR__ . '/BookController.php';
require_once __DIR__ . '/IssuanceController.php';
require_once __DIR__ . '/ReaderController.php';

class Router
{
    private array $routes = [
        '/books' => [BookController::class, 'index'],// пусть к странице со списком книг
        '/books/show' => [BookController::class, 'show'],// пусть к странице с деталями книги
        '/books/create' => [BookController::class, 'create'], //путь к странице с добавлением новой книги в базу
        '/issuances' => [IssuanceController::class, 'index'],
        '/issuances/show' => [IssuanceController::class, 'show'],
        '/issuances/create' => [IssuanceController::class, 'create'],// пусть к странице с добавлением новой выдачи
        '/readers/create' => [ReaderController::class, 'create'],  // пусть к странице с добавлением нового читателя
        '/readers' => [ReaderController::class, 'index'],// пусть к странице со списком читателей
        '/readers/show' => [ReaderController::class, 'show'],  // пусть к странице с одним читателем


    ];

    public function run(): void
    {
        $uri = parse_url(
            $_SERVER['REQUEST_URI'],
            PHP_URL_PATH
        );

        // Убираем префикс, если проект в подпапке
        $uri = str_replace('/library-php', '', $uri);

        if (isset($this->routes[$uri])) {
            [$controllerClass, $method] = $this->routes[$uri];

            $controller = new $controllerClass();

            // Передаём GET параметры в контроллер
            $controller->$method($_GET);

            return;
        }

        http_response_code(404);

        echo 'Страница не найдена';
    }
}
