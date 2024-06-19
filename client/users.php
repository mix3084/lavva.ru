<?
require_once '../db.php'; // Подключаем файл подключения к базе данных
session_start();

// Проверка наличия GET-параметра page
$page = $_GET['page'] ?? null;

if ($page === 'users') {
    // Проверка, авторизован ли пользователь
    if (!isset($_SESSION['user'])) {
        header('Location: /client/');
        exit();
    }

    // Дополнительная проверка на администратора (если нужно)
    if ($_SESSION['user']['group'] != 1) {
        echo "У вас нет доступа к этой странице.";
        exit();
    }
} else {
	header('Location: /client/');
}

$users = $pdo->query('SELECT * FROM users')->fetchAll();
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