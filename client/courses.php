<?php
require_once '../db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['add_course'])) {
		$name = $_POST['name'];
		$stmt = $pdo->prepare('INSERT INTO courses (name) VALUES (?)');
		$stmt->execute([$name]);
	} elseif (isset($_POST['delete_course'])) {
		$courseId = $_POST['course_id'];
		$stmt = $pdo->prepare('DELETE FROM courses WHERE id = ?');
		$stmt->execute([$courseId]);
	}
}
$courses = $pdo->query('SELECT * FROM courses')->fetchAll();
?>
<h2>Курсы</h2>
<form method="post">
	<div class="mb-3">
		<label for="name" class="form-label">Название курса</label>
		<input type="text" class="form-control" id="name" name="name" required>
	</div>
	<button type="submit" name="add_course" class="btn btn-primary">Добавить курс</button>
</form>

<h3 class="mt-4">Список курсов</h3>
<ul class="list-group">
	<?php foreach ($courses as $course): ?>
		<li class="list-group-item d-flex justify-content-between align-items-center">
			<?php echo htmlspecialchars($course['name']); ?>
			<form method="post" class="d-inline">
				<input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
				<button type="submit" name="delete_course" class="btn btn-danger btn-sm">Удалить</button>
			</form>
		</li>
	<?php endforeach; ?>
</ul>
