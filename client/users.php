<?
require_once '../db.php'; // Подключаем файл подключения к базе данных
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['update_user_courses'])) {
		$userId = $_POST['user_id'];
		$courses = implode(',', $_POST['courses']);
		$stmt = $pdo->prepare('UPDATE users SET courses = ? WHERE id = ?');
		$stmt->execute([$courses, $userId]);
	}
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
	<tbody>
		<?php foreach ($users as $user): ?>
			<tr>
				<td><?php echo htmlspecialchars($user['id']); ?></td>
				<td><?php echo htmlspecialchars($user['mail']); ?></td>
				<td><?php echo htmlspecialchars($user['name']); ?></td>
				<td><?php echo htmlspecialchars($user['login']); ?></td>
				<td><?php echo htmlspecialchars($user['group'] == 1 ? 'Admin' : 'User'); ?></td>
				<td><?php echo htmlspecialchars($user['courses']); ?></td>
				<td>
					<button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal<?php echo $user['id']; ?>">Редактировать курсы</button>

					<!-- Modal -->
					<div class="modal fade" id="editUserModal<?php echo $user['id']; ?>" tabindex="-1" aria-labelledby="editUserModalLabel<?php echo $user['id']; ?>" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="editUserModalLabel<?php echo $user['id']; ?>">Редактировать курсы для <?php echo htmlspecialchars($user['name']); ?></h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<form method="post">
										<input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
										<div class="mb-3">
											<label for="courses<?php echo $user['id']; ?>" class="form-label">Курсы</label>
											<select class="form-select" id="courses<?php echo $user['id']; ?>" name="courses[]" multiple>
												<?php foreach ($courses as $course): ?>
													<option value="<?php echo $course['id']; ?>" <?php echo in_array($course['id'], explode(',', $user['courses'])) ? 'selected' : ''; ?>>
														<?php echo htmlspecialchars($course['name']); ?>
													</option>
												<?php endforeach; ?>
											</select>
										</div>
										<button type="submit" name="update_user_courses" class="btn btn-primary">Сохранить</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>