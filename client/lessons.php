<?php
require_once '../db.php'; 		// Подключаем файл для работы с базой данных
session_start(); 				// Начинаем сессию
$page = $_GET['page'] ?? null; 	// Получаем параметр 'page' из URL, если он существует

// Проверяем, если 'page' не равно 'lessons', перенаправляем на страницу клиента
if ($page !== 'lessons') {
    header('Location: /client/');
    exit();
}

// Функция для очистки имени файла от запрещенных символов и ограничения длины
function sanitizeFileName($filename, $maxLength = 100) {
    $filename = preg_replace('/[^A-Za-zА-Яа-я0-9\- ]/u', '', $filename); // Удаляем все запрещенные символы, поддерживаем кириллицу
    if (strlen($filename) > $maxLength) {
        $filename = mb_substr($filename, 0, $maxLength); // Обрезаем строку до указанной длины
    }
    $filename = trim($filename); 					// Убираем начальные и конечные пробелы
    $filename = str_replace(' ', '_', $filename); 	// Заменяем пробелы на подчеркивания
    return $filename;
}

$user = $_SESSION['user']; // Получаем информацию о пользователе из сессии

// Получаем все курсы из базы данных
$courses = $pdo->query('SELECT * FROM courses')->fetchAll();

// Если пользователь является администратором, получаем все лекции
if ($user['group'] == 1) {
    $lessons = $pdo->query('SELECT lessons.*, courses.name AS course_name FROM lessons JOIN courses ON lessons.course_id = courses.id')->fetchAll();
} else {
    // Если пользователь не администратор, получаем только те лекции, которые относятся к курсам пользователя
    $userCourses = explode(',', $user['courses']); // Преобразуем строку с курсами пользователя в массив
    if (!empty($userCourses)) {
        $placeholders = implode(',', array_fill(0, count($userCourses), '?')); // Создаем строку плейсхолдеров для подготовленного запроса
        $stmt = $pdo->prepare("SELECT lessons.*, courses.name AS course_name FROM lessons JOIN courses ON lessons.course_id = courses.id WHERE lessons.course_id IN ($placeholders)"); 				// Подготавливаем запрос
        $stmt->execute($userCourses); 	// Выполняем запрос с параметрами
        $lessons = $stmt->fetchAll(); 	// Получаем результаты
    } else {
        $lessons = []; // Если у пользователя нет курсов, инициализируем пустой массив для лекций
    }
}
?>
<h2>Лекции</h2>
<?php if ($user['group'] == 1): ?>
	<form id="addLessonForm" enctype="multipart/form-data" class="mb-3">
		<div class="mb-3">
			<label for="name" class="form-label">Название лекции</label>
			<input type="text" class="form-control" id="name" name="name" required>
		</div>
		<div class="mb-3">
			<label for="file" class="form-label">Файл</label>
			<input type="file" class="form-control" id="file" name="file" required>
		</div>
		<div class="mb-3">
			<label for="course_id" class="form-label">Курс</label>
			<select class="form-select" id="course_id" name="course_id" required>
				<?php foreach ($courses as $course): ?>
					<option value="<?php echo $course['id']; ?>"><?php echo htmlspecialchars($course['name']); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<button type="submit" class="btn btn-primary">Добавить лекцию</button>
	</form>
<?php endif; ?>
<ul class="list-group">
	<?php if ($lessons): ?>
		<?php foreach ($lessons as $lesson): ?>
			<li class="list-group-item d-flex justify-content-between align-items-center" data-id="<?php echo $lesson['id']; ?>">
				<?php echo htmlspecialchars($lesson['name']) . ' (' . htmlspecialchars($lesson['course_name']) . ')'; ?>
				<?php 
					$filePath = htmlspecialchars($lesson['file_path']);
					$fileInfo = pathinfo($filePath);
					$fileExtension = isset($fileInfo['extension']) ? $fileInfo['extension'] : '';
				?>
				<a href="<?php echo $filePath; ?>" class="btn btn-info btn-sm ms-auto" download="<?php echo sanitizeFileName($lesson['name']) . '.' . $fileExtension; ?>">Скачать</a>
				<?php if ($user['group'] == 1): ?>
					<button class="btn btn-danger btn-sm ms-2 delete-lesson" data-id="<?php echo $lesson['id']; ?>">Удалить</button>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
	<?php else: ?>
		<li class="list-group-item justify-content-between align-items-center js-lessons-not">Лекций нет</li>
	<?php endif; ?>
</ul>