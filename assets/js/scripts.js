const App = {
	init: function() {
		this.bindEvents();
		this.loadUsers();
	},
	
	bindEvents: function() {
		$('#loginForm').on('submit', this.handleLogin);
		$('#registerForm').on('submit', this.handleRegister);
		$('#profileForm').on('submit', this.updateProfile);
		$('#passwordForm').on('submit', this.updatePassword);
		$(document).on('submit', '.editUserForm', this.updateUserCourses);
	},
	
	handleLogin: function(e) {
		e.preventDefault();
		let loginInput  = $('#loginInput').val();
		let password = $('#loginPassword').val();
		
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
						location.reload(); // Reload the page on success
					},1000);
				}
			}
		});
	},
	
	handleRegister: function(e) {
		e.preventDefault();
		let name = $('#registerName').val();
		let email = $('#registerEmail').val();
		let login = $('#registerLogin').val();
		let password = $('#registerPassword').val();
		
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

                if (response.success) $(e.currentTarget)[0].reset();
			}
		});
	},
	
	updateProfile: function(e) {
		e.preventDefault();
		$.ajax({
			url: '/client/profile.php',
			type: 'POST',
			data: {
				action: 'update_profile',
				name: $('#name').val()
			},
			dataType: 'json',
			success: function(response) {
				let message = $('#profileMessage');
				message.text(response.message);
				message.removeClass('alert-success alert-danger').addClass(response.success ? 'alert alert-success' : 'alert alert-danger');
			}
		});
	},
	
	updatePassword: function(e) {
		e.preventDefault();
		let oldPassword = $('#old_password').val();
		let newPassword = $('#new_password').val();
		let confirmPassword = $('#confirm_password').val();

		if (newPassword !== confirmPassword) {
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
				old_password: oldPassword,
				new_password: newPassword,
				confirm_password: confirmPassword
			},
			dataType: 'json',
			success: function(response) {
				let message = $('#passwordMessage');
				message.text(response.message);
				message.removeClass('alert-success alert-danger').addClass(response.success ? 'alert alert-success' : 'alert alert-danger');
				
				if (response.success) $(e.currentTarget)[0].reset();
			}
		});
	},
	
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
						const users = response.users;
						const courses = response.courses;
		
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
							$('#usersTableBody').append(userRow);
						});
					}
				},
				error: function() {
					alert('Ошибка при загрузке данных.');
				}
			});
		}
	},
	
	updateUserCourses: function(e) {
		e.preventDefault();
		const form = $(this);
		const userId = form.find('input[name="user_id"]').val();
		const courses = form.find('select[name="courses[]"]').val();

		$.ajax({
			url: '/ajax/update_user_courses.php',
			type: 'POST',
			data: {
				user_id: userId,
				courses: courses ? courses : []
			},
			dataType: 'json',
			success: function(response) {
				if (response.success) {
					const coursesText = courses ? courses.map(courseId => App.coursesMap[courseId]).join(', ') : '';
					$('#userCourses' + userId).text(coursesText);
					$('#editUserModal' + userId).modal('hide');
				} else {
					alert('Ошибка при обновлении курсов.');
				}
			},
			error: function() {
				alert('Ошибка при обработке запроса.');
			}
		});
	},
	
	coursesMap: {}
};

$(document).ready(function() {
	App.init();
});
