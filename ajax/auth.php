<?php
session_start();
require_once '../db.php'; // Подключаем файл подключения к базе данных

header('Content-Type: application/json');

$action = $_POST['action'];

if ($action == 'login') {
	$email = $_POST['email'];
	$password = md5($_POST['password']); // Использование MD5 для хэширования паролей

	$stmt = $pdo->prepare('SELECT * FROM users WHERE mail = ? AND password = ?');
	$stmt->execute([$email, $password]);
	$user = $stmt->fetch();

	if ($user) {
		echo json_encode(['success' => true, 'message' => 'Вход выполнен успешно.']);
		$_SESSION['user'] = $user;
	} else {
		echo json_encode(['success' => false, 'message' => 'Неверный email или пароль.']);
	}
} elseif ($action == 'register') {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$login = $_POST['login'];
	$password = md5($_POST['password']); // Использование MD5 для хэширования паролей

	// Проверка на существование пользователя с таким же email или логином
	$stmt = $pdo->prepare('SELECT * FROM users WHERE mail = ? OR login = ?');
	$stmt->execute([$email, $login]);
	$existingUser = $stmt->fetch();

	if ($existingUser) {
		echo json_encode(['success' => false, 'message' => 'Пользователь с таким email или логином уже существует.']);
	} else {
		// Вставка нового пользователя
		$stmt = $pdo->prepare('INSERT INTO users (mail, name, login, password, `group`, courses) VALUES (?, ?, ?, ?, ?, ?)');
		$stmt->execute([$email, $name, $login, $password, 2, '']);
		echo json_encode(['success' => true, 'message' => 'Регистрация прошла успешно.']);
	}
}
?>
