<?php

class HomeController
{
	public function home(array $params): void
	{

	include __DIR__ . '/../views/home/index.html';
	}
}

?>