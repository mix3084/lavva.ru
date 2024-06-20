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
('admin@example.com', 'Администратор', 'admin', MD5('admin'), 1, ''),
('petrov.petr@example.com', 'Петров Петр Петрович', 'petrov_petr', MD5('password456'), 2, '1,3'),
('sidorov.alexey@example.com', 'Сидоров Алексей Сидорович', 'sidorov_alexey', MD5('password789'), 2, '1'),
('smirnova.anna@example.com', 'Смирнова Анна Сергеевна', 'smirnova_anna', MD5('password101112'), 2, '2,3'),
('kozlov.dmitry@example.com', 'Козлов Дмитрий Иванович', 'kozlov_dmitry', MD5('password131415'), 2, '2'),
('novikova.olga@example.com', 'Новикова Ольга Николаевна', 'novikova_olga', MD5('password161718'), 2, '1,2,3');


-- Вставка данных в таблицу courses
INSERT INTO courses (name) VALUES
('HTML и CSS'),
('JavaScript'),
('Книги');

-- Вставка данных в таблицу lessons
INSERT INTO lessons (course_id, name, file_path) VALUES
(1, 'Заключение', '/uploads/Заключение.mp4'),
(2, 'Настройка рабочего пространства', '/uploads/Список необходимых плагинов.docx'),
(3, 'Изучаем HTML, XHTML и CSS Эрик Фримен', '/uploads/Изучаем HTML, XHTML и CSS Эрик Фримен.pdf'),