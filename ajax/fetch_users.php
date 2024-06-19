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
    echo json_encode([]);
    exit();
}

$users = $pdo->query('SELECT * FROM users')->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($users);
?>
