-- Создание базы данных
CREATE DATABASE IF NOT EXISTS course_management;
USE course_management;

-- Создание таблицы с учетными записями
CREATE TABLE IF NOT EXISTS users (
	id INT AUTO_INCREMENT PRIMARY KEY,
	mail VARCHAR(255) NOT NULL,
	name VARCHAR(255) NOT NULL,
	login VARCHAR(255) NOT NULL,
	password VARCHAR(32) NOT NULL, -- Храним MD5-хеш
	`group` INT NOT NULL,
	courses TEXT
);

-- Создание таблицы с группами
CREATE TABLE IF NOT EXISTS groups (
	id INT AUTO_INCREMENT PRIMARY KEY,
	`group` VARCHAR(50) NOT NULL,
	lvl INT NOT NULL
);

-- Создание таблицы с курсами
CREATE TABLE IF NOT EXISTS courses (
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL
);

-- Создание таблицы с уроками
CREATE TABLE IF NOT EXISTS lessons (
	id INT AUTO_INCREMENT PRIMARY KEY,
	course_id INT NOT NULL,
	name VARCHAR(255) NOT NULL,
	file_path VARCHAR(255),
	FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

-- Вставка данных в таблицу groups
INSERT INTO groups (`group`, lvl) VALUES
('admin', 1),
('user', 2);

-- Вставка данных в таблицу users
INSERT INTO users (mail, name, login, password, `group`, courses) VALUES
('admin@example.com', 'Администратор', 'admin', MD5('admin'), 1, '1,2'),
('petrov.petr@example.com', 'Петров Петр Петрович', 'petrov_petr', MD5('password456'), 2, '1'),
('sidorov.alexey@example.com', 'Сидоров Алексей Сидорович', 'sidorov_alexey', MD5('password789'), 2, '1'),
('smirnova.anna@example.com', 'Смирнова Анна Сергеевна', 'smirnova_anna', MD5('password101112'), 2, '2'),
('kozlov.dmitry@example.com', 'Козлов Дмитрий Иванович', 'kozlov_dmitry', MD5('password131415'), 2, '2'),
('novikova.olga@example.com', 'Новикова Ольга Николаевна', 'novikova_olga', MD5('password161718'), 2, '1,2');


-- Вставка данных в таблицу courses
INSERT INTO courses (name) VALUES
('Course 1'),
('Course 2');

-- Вставка данных в таблицу lessons
INSERT INTO lessons (course_id, name, file_path) VALUES
(1, 'Lesson 1 for Course 1', '/uploads/521f0cf09bc65babd9584b6e8ac6b6f5.mp4'),
(1, 'Lesson 2 for Course 1', '/uploads/434d7a93a0be916f053567ea6c72a176.docx'),
(2, 'Lesson 1 for Course 2', '/uploads/file3.pdf'),
(2, 'Lesson 2 for Course 2', '/uploads/file4.pdf');
