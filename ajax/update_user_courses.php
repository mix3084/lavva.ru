<?php
session_start();
require_once '../db.php';

// Проверка авторизации и роли администратора
if (!isset($_SESSION['user']) || $_SESSION['user']['group'] != 1) {
    header('HTTP/1.0 403 Forbidden');
    echo json_encode(['error' => 'Доступ запрещен']);
    exit();
}

// Проверка наличия таблицы
$tableExists = $pdo->query("SHOW TABLES LIKE 'users'")->rowCount() > 0;
if (!$tableExists) {
    echo json_encode(['error' => 'Таблица не существует']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $courses = implode(',', $_POST['courses']);

    $stmt = $pdo->prepare('UPDATE users SET courses = ? WHERE id = ?');
    $stmt->execute([$courses, $userId]);

    echo json_encode(['success' => true]);
}
?>
