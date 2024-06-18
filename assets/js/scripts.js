$(document).ready(function() {
    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        let email = $('#loginEmail').val();
        let password = $('#loginPassword').val();
        
        $.ajax({
            url: '/ajax/auth.php',
            type: 'POST',
            data: {
                action: 'login',
                email: email,
                password: password
            },
            success: function(response) {
                $('#loginMessage').text(response.message);
                if (response.success) {
                    setTimeout(()=>{
                        location.reload(); // Reload the page on success
                    },1000)
                }
            }
        });
    });

    $('#registerForm').on('submit', function(e) {
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
                name: name,
                email: email,
                login: login,
                password: password
            },
            success: function(response) {
                $('#registerMessage').text(response.message);
            }
        });
    });
    $('#profileForm').on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			url: 'profile.php',
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
	});

	$('#passwordForm').on('submit', function(e) {
		e.preventDefault();
		let newPassword = $('#new_password').val();
		let confirmPassword = $('#confirm_password').val();

		if (newPassword !== confirmPassword) {
			let message = $('#passwordMessage');
			message.text('Пароли не совпадают');
			message.removeClass('alert-success').addClass('alert alert-danger');
			return;
		}

		$.ajax({
			url: 'profile.php',
			type: 'POST',
			data: {
				action: 'update_password',
				new_password: newPassword,
				confirm_password: confirmPassword
			},
			dataType: 'json',
			success: function(response) {
				let message = $('#passwordMessage');
				message.text(response.message);
				message.removeClass('alert-success alert-danger').addClass(response.success ? 'alert alert-success' : 'alert alert-danger');
			}
		});
	});
});