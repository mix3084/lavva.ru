<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$response = ['success' => false, 'message' => ''];

	if (isset($_POST['action'])) {
		if ($_POST['action'] === 'update_profile') {
			$name = $_POST['name'];
			$userId = $_SESSION['user']['id'];

			$query = 'UPDATE users SET name = ? WHERE id = ?';
			$params = [$name, $userId];

			$stmt = $pdo->prepare($query);
			$stmt->execute($params);

			$_SESSION['user']['name'] = $name;

			$response['success'] = true;
			$response['message'] = 'Профиль обновлен';
		} elseif ($_POST['action'] === 'update_password') {
			$newPassword = md5($_POST['new_password']);
			$userId = $_SESSION['user']['id'];

			$query = 'UPDATE users SET password = ? WHERE id = ?';
			$params = [$newPassword, $userId];

			$stmt = $pdo->prepare($query);
			$stmt->execute($params);

			$response['success'] = true;
			$response['message'] = 'Пароль успешно изменен';
		}
	}

	echo json_encode($response);
	exit();
}
?>
<h2>Профиль</h2>
<form id="profileForm" method="post">
	<div class="mb-3">
		<label for="name" class="form-label">Имя</label>
		<input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
	</div>
	<button type="submit" class="btn btn-primary">Сохранить</button>
	<div id="profileMessage" class="mt-3"></div>
</form>

<h2 class="mt-5">Изменить пароль</h2>
<form id="passwordForm" method="post">
	<div class="mb-3">
		<label for="new_password" class="form-label">Новый пароль</label>
		<input type="password" class="form-control" id="new_password" name="new_password" required>
	</div>
	<div class="mb-3">
		<label for="confirm_password" class="form-label">Пароль еще раз</label>
		<input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
	</div>
	<button type="submit" class="btn btn-primary">Изменить пароль</button>
	<div id="passwordMessage" class="mt-3"></div>
</form>