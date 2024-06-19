<?php
require_once '../db.php';
session_start();

// Проверка наличия GET-параметра page
$page = $_GET['page'] ?? null;

if ($page === 'courses') {
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
    exit();
}

$courses = $pdo->query('SELECT * FROM courses')->fetchAll();
?>
<h2>Курсы</h2>
<form id="addCourseForm" class="mb-3">
	<div class="mb-3">
		<label for="name" class="form-label">Название курса</label>
		<input type="text" class="form-control" id="name" name="name" required>
	</div>
	<button type="submit" class="btn btn-primary">Добавить курс</button>
</form>

<ul class="list-group" id="coursesList">
	<?php foreach ($courses as $course): ?>
		<li class="list-group-item d-flex justify-content-between align-items-center" data-id="<?php echo $course['id']; ?>">
			<?php echo htmlspecialchars($course['name']); ?>
			<button class="btn btn-danger btn-sm delete-course">Удалить</button>
		</li>
	<?php endforeach; ?>
</ul>