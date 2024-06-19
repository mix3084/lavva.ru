<?php
header('Content-Type: application/json');

require_once '../db.php';
session_start();

$user = $_SESSION['user'];

$response = ['success' => false, 'message' => 'Произошла ошибка'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user['group'] == 1) {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add_lesson') {
            $name = $_POST['name'];
            $courseId = $_POST['course_id'];

            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['file']['tmp_name'];
                $fileName = $_FILES['file']['name'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));

                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                $uploadFileDir = '../uploads/';

                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0755, true);
                }

                $dest_path = $uploadFileDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $stmt = $pdo->prepare('INSERT INTO lessons (course_id, name, file_path) VALUES (?, ?, ?)');
                    if ($stmt->execute([$courseId, $name, $dest_path])) {
                        $courseStmt = $pdo->prepare('SELECT name FROM courses WHERE id = ?');
                        $courseStmt->execute([$courseId]);
                        $course = $courseStmt->fetchColumn();

                        $response['success'] = true;
                        $response['message'] = 'Лекция добавлена';
                        $response['lesson'] = [
                            'id' => $pdo->lastInsertId(),
                            'name' => $name,
                            'course_name' => $course,
                            'file_path' => $dest_path,
                            'file_extension' => $fileExtension
                        ];
                    }
                }
            }
        } elseif ($_POST['action'] === 'delete_lesson') {
            $lessonId = $_POST['lesson_id'];
            $stmt = $pdo->prepare('SELECT file_path FROM lessons WHERE id = ?');
            $stmt->execute([$lessonId]);
            $lesson = $stmt->fetch();

            if ($lesson && file_exists($lesson['file_path'])) {
                unlink($lesson['file_path']);
            }

            $stmt = $pdo->prepare('DELETE FROM lessons WHERE id = ?');
            if ($stmt->execute([$lessonId])) {
                $response['success'] = true;
                $response['message'] = 'Лекция удалена';
            }
        }
    }
}

echo json_encode($response);
exit();
?>
