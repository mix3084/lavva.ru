<?php
session_start();
require_once '../db.php';

header('Content-Type: application/json');

// Проверка авторизации и роли администратора
if (!isset($_SESSION['user']) || $_SESSION['user']['group'] != 1) {
    header('HTTP/1.0 403 Forbidden');
    echo json_encode(['error' => 'Доступ запрещен']);
    exit();
}

// Получение пользователей и курсов
$users = $pdo->query('SELECT * FROM users')->fetchAll(PDO::FETCH_ASSOC);
$courses = $pdo->query('SELECT * FROM courses')->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as &$user) {
    $userCourses = explode(',', $user['courses']);
    $user['course_names'] = [];

    foreach ($userCourses as $courseId) {
        foreach ($courses as $course) {
            if ($course['id'] == $courseId) {
                $user['course_names'][] = $course['name'];
            }
        }
    }
    $user['course_names'] = implode(', ', $user['course_names']);
}

echo json_encode(['users' => $users, 'courses' => $courses]);
?>
