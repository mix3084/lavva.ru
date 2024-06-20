<?php

header('Content-Type: application/json');

require_once '../db.php';
session_start();

// Проверка, авторизован ли пользователь
if (!isset($_SESSION['user']) || $_SESSION['user']['group'] != 1) {
    echo json_encode(['success' => false, 'message' => 'Доступ запрещен']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => 'Произошла ошибка'];
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add_course') {
            $name = $_POST['name'];
            $stmt = $pdo->prepare('INSERT INTO courses (name) VALUES (?)');
            if ($stmt->execute([$name])) {
                $response['success']    = true;
                $response['message']    = 'Курс добавлен';
                $response['id']         = $pdo->lastInsertId();
                $response['name']       = $name;
            }
        } elseif ($_POST['action'] === 'delete_course') {
            $courseId = $_POST['course_id'];
            $stmt = $pdo->prepare('DELETE FROM courses WHERE id = ?');
            if ($stmt->execute([$courseId])) {
                $response['success'] = true;
                $response['message'] = 'Курс удален';
            }
        }
    }

    echo json_encode($response);
}
exit();
?>
