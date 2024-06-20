<?php
require_once '../db.php'; // Подключаем файл для работы с базой данных
session_start(); // Начинаем сессию

// Проверка наличия GET-параметра page
$page = $_GET['page'] ?? null;

// Проверка, если страница 'users'
if ($page === 'users') {
    // Проверка, авторизован ли пользователь
    if (!isset($_SESSION['user'])) {
        header('Location: /client/'); // Перенаправление на страницу клиента, если пользователь не авторизован
        exit();
    }

    // Дополнительная проверка на администратора
    if ($_SESSION['user']['group'] != 1) {
        echo "У вас нет доступа к этой странице."; // Вывод сообщения, если пользователь не является администратором
        exit();
    }
} else {
    header('Location: /client/'); // Перенаправление на страницу клиента, если параметр 'page' не равен 'users'
    exit();
}

// Получение всех пользователей из базы данных
$users = $pdo->query('SELECT * FROM users')->fetchAll();
// Получение всех курсов из базы данных
$courses = $pdo->query('SELECT * FROM courses')->fetchAll();
?>
<h2>Пользователи</h2>
<table class="table table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>Email</th>
			<th>Имя</th>
			<th>Логин</th>
			<th>Группа</th>
			<th>Курсы</th>
			<th>Действия</th>
		</tr>
	</thead>
	<tbody id="usersTableBody">
		<!-- Динамически загруженные пользователи будут вставляться сюда -->
	</tbody>
</table>