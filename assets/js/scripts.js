const App = {
	// Инициализация приложения
	init: function() {
		this.bindEvents(); 	// Привязка событий
		this.loadUsers(); 	// Загрузка пользователей
	},
	
	// Привязка событий к элементам
	bindEvents: function() {
		$('#loginForm').on('submit', 	this.handleLogin); 							// Событие для формы входа
		$('#registerForm').on('submit', this.handleRegister); 						// Событие для формы регистрации
		$('#profileForm').on('submit', 	this.updateProfile); 						// Событие для обновления профиля
		$('#passwordForm').on('submit', this.updatePassword); 						// Событие для обновления пароля
		$(document).on('submit', '.editUserForm', 	this.updateUserCourses); 		// Событие для обновления курсов пользователя
		$(document).on('submit', '#addCourseForm', 	this.addCourse); 				// Событие для добавления курса
		$(document).on('click', '.delete-course', 	this.deleteCourse); 			// Событие для удаления курса
		$('#addLessonForm').on('submit', 			this.addLesson.bind(this)); 	// Событие для добавления лекции
        $(document).on('click', '.delete-lesson', 	this.deleteLesson.bind(this)); 	// Событие для удаления лекции
	},
	
	handleLogin: function(e) {
		e.preventDefault();
		const 
			loginInput  = $('#loginInput').val(),
			password 	= $('#loginPassword').val();
		
		$.ajax({
			url: '/ajax/auth.php',
			type: 'POST',
			data: {
				action: 'login',
				loginInput,
				password
			},
			success: function(response) {
				$('#loginMessage').text(response.message);
				if (response.success) {
					setTimeout(()=>{
						location.reload();
					},1000); // 1000 мс = 1 сек.
				}
			}
		});
	},
	
	// Обработка входа
	handleLogin: function(e) {
		e.preventDefault();
		const 
			loginInput  = $('#loginInput').val(),
			password 	= $('#loginPassword').val();
		
		$.ajax({
			url: '/ajax/auth.php',
			type: 'POST',
			data: {
				action: 'login',
				loginInput,
				password
			},
			success: response => {
				const { success, message } = response

				$('#loginMessage').text(message);
				if (success) {
					setTimeout(()=>{
						location.reload(); // Перезагрузка страницы при успешном входе
					},1000);
				}
			}
		});
	},

    // Обработка регистрации
	handleRegister: function(e) {
		e.preventDefault();
		const 
			name 		= $('#registerName').val(),
			email 		= $('#registerEmail').val(),
			login 		= $('#registerLogin').val(),
			password 	= $('#registerPassword').val();
		
		$.ajax({
			url: '/ajax/auth.php',
			type: 'POST',
			data: {
				action: 'register',
				name,
				email,
				login,
				password
			},
			success: function(response) {
				$('#registerMessage').text(response.message);

                if (response.success) $(e.currentTarget)[0].reset(); // Сброс формы при успешной регистрации
			}
		});
	},

    // Обновление профиля
	updateProfile: function(e) {
		const name = $('#name').val();

		e.preventDefault();
		$.ajax({
			url: '/client/profile.php',
			type: 'POST',
			data: {
				action: 'update_profile',
				name
			},
			dataType: 'json',
			success: function(response) {
				let message = $('#profileMessage');
				message.text(response.message);
				$('#username').text(name)
				message.removeClass('alert-success alert-danger').addClass(response.success ? 'alert alert-success' : 'alert alert-danger');
			}
		});
	},

    // Обновление пароля
	updatePassword: function(e) {
		e.preventDefault();
		const
			old_password	= $('#old_password').val(),
			new_password 	= $('#new_password').val(),
			confirm_password = $('#confirm_password').val();

		if (new_password !== confirm_password) {
			let message = $('#passwordMessage');
			message.text('Пароли не совпадают');
			message.removeClass('alert-success').addClass('alert alert-danger');
			return;
		}

		$.ajax({
			url: '/client/profile.php',
			type: 'POST',
			data: {
				action: 'update_password',
				old_password,
				new_password,
				confirm_password
			},
			dataType: 'json',
			success: function(response) {
				let message = $('#passwordMessage');
				message.text(response.message);
				message.removeClass('alert-success alert-danger').addClass(response.success ? 'alert alert-success' : 'alert alert-danger');
				
				if (response.success) $(e.currentTarget)[0].reset(); // Сброс формы при успешном обновлении пароля
			}
		});
	},

    // Загрузка пользователей
	loadUsers: function() {
		const self = this;
		if ($('#usersTableBody').length) {
			$.ajax({
				url: '/ajax/fetch_users.php',
				type: 'GET',
				dataType: 'json',
				success: function(response) {
					if (response.error) {
						alert(response.error);
					} else {
						const { users, courses } = response;
		
						courses.forEach(course => {
							self.coursesMap[course.id] = course.name;
						});
		
						users.forEach(user => {
							const userRow = `
								<tr id="userRow${user.id}">
									<td>${user.id}</td>
									<td>${user.mail}</td>
									<td>${user.name}</td>
									<td>${user.login}</td>
									<td>${user.group == 1 ? 'Admin' : 'User'}</td>
									<td id="userCourses${user.id}">${user.course_names}</td>
									<td>
										<button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal${user.id}">Редактировать курсы</button>
										<div class="modal fade" id="editUserModal${user.id}" tabindex="-1" aria-labelledby="editUserModalLabel${user.id}" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="editUserModalLabel${user.id}">Редактировать курсы для ${user.name}</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">
														<form id="editUserForm${user.id}" class="editUserForm">
															<input type="hidden" name="user_id" value="${user.id}">
															<div class="mb-3">
																<label for="courses${user.id}" class="form-label">Курсы</label>
																<select class="form-select" id="courses${user.id}" name="courses[]" multiple>
																	${courses.map(course => `<option value="${course.id}" ${user.courses.split(',').includes(String(course.id)) ? 'selected' : ''}>${course.name}</option>`).join('')}
																</select>
															</div>
															<button type="submit" class="btn btn-primary">Сохранить</button>
														</form>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>`;
							$('#usersTableBody').append(userRow); // Добавление строки пользователя в таблицу
						});
					}
				},
				error: function() {
					alert('Ошибка при загрузке данных.');
				}
			});
		}
	},

    // Добавление курса
    addCourse: function(e) {
		e.preventDefault();
		const name = $('#name').val();

		$.ajax({
			url: '/ajax/courses.php',
			type: 'POST',
			data: {
				action: 'add_course',
				name
			},
			dataType: 'json',
			success: function(response) {
				if (response.success) {
					$('#coursesList').append(`
						<li class="list-group-item d-flex justify-content-between align-items-center" data-id="${response.id}">
							${response.name}
							<button class="btn btn-danger btn-sm delete-course">Удалить</button>
						</li>
					`);
					$('#name').val(''); // Очистка поля ввода имени курса
				} else {
					alert(response.message);
				}
			}
		});
	},

    // Удаление курса
    deleteCourse: function() {
		const 
			listItem 	= $(this).closest('li'),
			course_id 	= listItem.data('id');

		$.ajax({
			url: '/ajax/courses.php',
			type: 'POST',
			data: {
				action: 'delete_course',
				course_id
			},
			dataType: 'json',
			success: function(response) {
				if (response.success) {
					listItem.remove(); // Удаление элемента из списка
				} else {
					alert(response.message);
				}
			}
		});
	},

    // Обновление курсов пользователя
	updateUserCourses: function(e) {
		e.preventDefault(); // Предотвращаем отправку формы по умолчанию
		const 
			form 	= $(this), 										// Текущая форма
			user_id = form.find('input[name="user_id"]').val(), 	// Получаем ID пользователя
			courses = form.find('select[name="courses[]"]').val(); 	// Получаем выбранные курсы

		$.ajax({
			url: '/ajax/update_user_courses.php', // URL для отправки данных
			type: 'POST', // Метод HTTP-запроса
			data: {
				user_id,
				courses: courses ? courses : [] // Отправляем выбранные курсы или пустой массив
			},
			dataType: 'json', // Ожидаемый тип данных от сервера
			success: function(response) {
				if (response.success) {
					const coursesText = courses ? courses.map(courseId => App.coursesMap[courseId]).join(', ') : ''; // Формируем строку с названиями курсов
					$('#userCourses' + user_id).text(coursesText); // Обновляем список курсов пользователя
					$('#editUserModal' + user_id).modal('hide'); // Закрываем модальное окно
				} else {
					alert('Ошибка при обновлении курсов.'); // Сообщаем об ошибке
				}
			},
			error: function() {
				alert('Ошибка при обработке запроса.'); // Сообщаем о проблеме с запросом
			}
		});
	},

	// Проверка наличия лекций
	checkLessons: function() {
        const html = '<li class="list-group-item justify-content-between align-items-center js-lessons-not">Лекций нет</li>';

		if (!$('.list-group li[data-id]').length) {
			$('.list-group').append(html); // Добавляем сообщение, если лекций нет
		} else {
			$('.js-lessons-not').remove(); // Убираем сообщение, если лекции есть
		}
	},

	// Добавление лекции
    addLesson: function(e) {
        e.preventDefault(); // Предотвращаем отправку формы по умолчанию
        const formData = new FormData($('#addLessonForm')[0]); // Создаем объект FormData с данными формы
        formData.append('action', 'add_lesson'); // Добавляем действие

        $.ajax({
            url: '/ajax/lessons.php', 	// URL для отправки данных
            type: 'POST', 				// Метод HTTP-запроса
            data: formData, 			// Данные формы
            processData: false, 		// Отключаем обработку данных
            contentType: false, 		// Отключаем установку типа контента
            dataType: 'json', 			// Ожидаемый тип данных от сервера
            success: function(response) {
                if (response.success) {
                    const lesson = response.lesson; // Получаем данные добавленной лекции
                    const lessonItem = `
                        <li class="list-group-item d-flex justify-content-between align-items-center" data-id="${lesson.id}">
                            ${lesson.name} (${lesson.course_name})
                            <a href="${lesson.file_path}" class="btn btn-info btn-sm ms-auto" download="${App.sanitizeFileName(lesson.name)}.${lesson.file_extension}">Скачать</a>
                            <button class="btn btn-danger btn-sm ms-2 delete-lesson" data-id="${lesson.id}">Удалить</button>
                        </li>
                    `;
                    $('.list-group').append(lessonItem); 	// Добавляем новую лекцию в список
                    $('#addLessonForm')[0].reset(); 		// Сбрасываем форму
                    App.checkLessons(); 					// Проверяем наличие лекций
                } else {
                    alert(response.message); 				// Сообщаем об ошибке
                }
            },
            error: function() {
                alert('Ошибка при добавлении лекции.'); 	// Сообщаем о проблеме с запросом
            }
        });
    },

	// Удаление лекции
    deleteLesson: function(e) {
        const lesson_id = $(e.target).data('id'); // Получаем ID лекции

        $.ajax({
            url: '/ajax/lessons.php', 	// URL для отправки данных
            type: 'POST', 				// Метод HTTP-запроса
            data: {
                action: 'delete_lesson',
                lesson_id 				// ID лекции для удаления
            },
            dataType: 'json', 			// Ожидаемый тип данных от сервера
            success: function(response) {
                if (response.success) {
                    $(`li[data-id="${lesson_id}"]`).remove(); 	// Удаляем элемент списка
                    App.checkLessons(); 						// Проверяем наличие лекций
                } else {
                    alert(response.message); 					// Сообщаем об ошибке
                }
            },
            error: function() {
                alert('Ошибка при удалении лекции.'); // Сообщаем о проблеме с запросом
            }
        });
    },

	// Очистка и безопасное название файла
    sanitizeFileName: function(filename, maxLength = 100) {
        filename = filename.replace(/[^A-Za-zА-Яа-я0-9\- ]/g, ''); 	// Удаляем запрещенные символы
        if (filename.length > maxLength) {
            filename = filename.substring(0, maxLength); 			// Обрезаем строку до максимальной длины
        }
        filename = filename.trim().replace(/\s+/g, '_'); 			// Заменяем пробелы на подчеркивания
        return filename;
    },
	
	// Карта курсов
	coursesMap: {}
};

$(document).ready(function() {
	App.init();
});
