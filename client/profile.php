<?php
require_once '../db.php'; 	// Подключаем файл для работы с базой данных
session_start(); 			// Начинаем сессию

$page = $_GET['page'] ?? null; // Получаем параметр 'page' из URL, если он существует

// Проверяем, если пользователь не авторизован, перенаправляем на страницу клиента
if (!isset($_SESSION['user'])) {
	header('Location: /client/');
	exit();
}

$user = $_SESSION['user']; // Получаем информацию о пользователе из сессии

// Обработка POST-запросов
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$response = ['success' => false, 'message' => '']; // Инициализируем массив ответа

	if (isset($_POST['action'])) {
		if ($_POST['action'] === 'update_profile') { // Обновление профиля пользователя
			$name 	= $_POST['name'];
			$userId = $user['id'];

			$query 	= 'UPDATE users SET name = ? WHERE id = ?';
			$params = [$name, $userId];

			$stmt = $pdo->prepare($query); 	// Подготавливаем запрос
			$stmt->execute($params); 		// Выполняем запрос

			$_SESSION['user']['name'] = $name; // Обновляем имя в сессии

			$response['success'] = true;
			$response['message'] = 'Профиль обновлен';
		} elseif ($_POST['action'] === 'update_password') { // Обновление пароля пользователя
			$oldPassword = md5($_POST['old_password']); // Хешируем старый пароль
			$newPassword = md5($_POST['new_password']); // Хешируем новый пароль
			$userId = $user['id'];

			// Проверка старого пароля
			$stmt = $pdo->prepare('SELECT password FROM users WHERE id = ?');
			$stmt->execute([$userId]);
			$existingPassword = $stmt->fetchColumn();

			if ($existingPassword !== $oldPassword) { // Если старый пароль неверен
				$response['message'] = 'Старый пароль введен неправильно';
			} else { // Если старый пароль верен, обновляем пароль
				$query 	= 'UPDATE users SET password = ? WHERE id = ?';
				$params = [$newPassword, $userId];

				$stmt = $pdo->prepare($query); 	// Подготавливаем запрос
				$stmt->execute($params); 		// Выполняем запрос

				$response['success'] = true;
				$response['message'] = 'Пароль успешно изменен';
			}
		}
	}

	echo json_encode($response); 	// Возвращаем ответ в формате JSON
	exit(); 						// Останавливаем выполнение скрипта
}
?>
<h2>Профиль</h2>
<form id="profileForm" method="post">
	<div class="mb-3">
		<p><b>Логин:</b> <?php echo htmlspecialchars($user['login']); ?></p>
		<p><b>Email:</b> <?php echo htmlspecialchars($user['mail']); ?></p>
	</div>
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
		<label for="old_password" class="form-label">Старый пароль</label>
		<input type="password" class="form-control" id="old_password" name="old_password" required>
	</div>
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