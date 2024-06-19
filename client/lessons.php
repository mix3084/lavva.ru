<?php
function sanitizeFileName($filename, $maxLength = 100) {
	// Удаляем все запрещенные символы, поддерживаем кириллицу
	$filename = preg_replace('/[^A-Za-zА-Яа-я0-9\- ]/u', '', $filename);
	// Обрезаем строку до указанной длины
	if (strlen($filename) > $maxLength) {
		$filename = mb_substr($filename, 0, $maxLength);
	}
	// Убираем начальные и конечные пробелы
	$filename = trim($filename);
	// Заменяем пробелы на подчеркивания
	$filename = str_replace(' ', '_', $filename);
	return $filename;
}


require_once '../db.php';
session_start();

// Проверка, авторизован ли пользователь
if (!isset($_SESSION['user'])) {
	header('Location: /client/');
	exit();
}

$user = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user['group'] == 1) {
	if (isset($_POST['add_lesson'])) {
		$name = $_POST['name'];
		$courseId = $_POST['course_id'];

		if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
			$fileTmpPath = $_FILES['file']['tmp_name'];
			$fileName = $_FILES['file']['name'];
			$fileSize = $_FILES['file']['size'];
			$fileType = $_FILES['file']['type'];
			$fileNameCmps = explode(".", $fileName);
			$fileExtension = strtolower(end($fileNameCmps));

			$newFileName = md5(time() . $fileName) . '.' . $fileExtension;
			$uploadFileDir = '../uploads/';
			$dest_path = $uploadFileDir . $newFileName;

			if (move_uploaded_file($fileTmpPath, $dest_path)) {
				$stmt = $pdo->prepare('INSERT INTO lessons (course_id, name, file_path) VALUES (?, ?, ?)');
				$stmt->execute([$courseId, $name, $dest_path]);
			}
		}
	} elseif (isset($_POST['delete_lesson'])) {
		$lessonId = $_POST['lesson_id'];
		$stmt = $pdo->prepare('SELECT file_path FROM lessons WHERE id = ?');
		$stmt->execute([$lessonId]);
		$lesson = $stmt->fetch();

		if ($lesson && file_exists($lesson['file_path'])) {
			unlink($lesson['file_path']);
		}

		$stmt = $pdo->prepare('DELETE FROM lessons WHERE id = ?');
		$stmt->execute([$lessonId]);
	}
}

$courses = $pdo->query('SELECT * FROM courses')->fetchAll();

if ($user['group'] == 1) {
	$lessons = $pdo->query('SELECT lessons.*, courses.name AS course_name FROM lessons JOIN courses ON lessons.course_id = courses.id')->fetchAll();
} else {
	$userCourses = explode(',', $user['courses']);
	$placeholders = implode(',', array_fill(0, count($userCourses), '?'));
	$stmt = $pdo->prepare("SELECT lessons.*, courses.name AS course_name FROM lessons JOIN courses ON lessons.course_id = courses.id WHERE lessons.course_id IN ($placeholders)");
	$stmt->execute($userCourses);
	$lessons = $stmt->fetchAll();
}
?>

<h2>Лекции</h2>
<?php if ($user['group'] == 1): ?>
	<form method="post" enctype="multipart/form-data">
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
		<button type="submit" name="add_lesson" class="btn btn-primary">Добавить лекцию</button>
	</form>
<?php endif; ?>

<h3 class="mt-4">Список лекций</h3>
<ul class="list-group">
	<?php foreach ($lessons as $lesson): ?>
		<li class="list-group-item d-flex justify-content-between align-items-center">
			<?php echo htmlspecialchars($lesson['name']) . ' (' . htmlspecialchars($lesson['course_name']) . ')'; ?>
			<a href="<?php echo htmlspecialchars($lesson['file_path']); ?>" class="btn btn-info btn-sm ms-auto" download="<?php echo sanitizeFileName($lesson['name']) . '.pdf'; ?>">Скачать</a>
			<?php if ($user['group'] == 1): ?>
				<form method="post" class="d-inline ms-2">
					<input type="hidden" name="lesson_id" value="<?php echo $lesson['id']; ?>">
					<button type="submit" name="delete_lesson" class="btn btn-danger btn-sm">Удалить</button>
				</form>
			<?php endif; ?>
		</li>
	<?php endforeach; ?>
</ul>
