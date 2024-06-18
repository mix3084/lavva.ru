<?php
$title = "Личный кабинет";
$description = "ХУЙНЯ.";

include '../header.php';
session_start();
$user = $_SESSION['user'];
if (!isset($user)) : ?>
<!-- шапка Start -->
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">Личный кабинет</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="/">Главная</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Личный кабинет</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- End -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <h3>Вход</h3>
                <form id="loginForm">
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="loginEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Пароль</label>
                        <input type="password" class="form-control" id="loginPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Войти</button>
                    <div id="loginMessage" class="mt-3"></div>
                </form>
            </div>
            <div class="col-md-6">
                <h3>Регистрация</h3>
                <form id="registerForm">
                    <div class="mb-3">
                        <label for="registerName" class="form-label">Имя</label>
                        <input type="text" class="form-control" id="registerName" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="registerEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerLogin" class="form-label">Логин</label>
                        <input type="text" class="form-control" id="registerLogin" required>
                    </div>
                    <div class="mb-3">
                        <label for="registerPassword" class="form-label">Пароль</label>
                        <input type="password" class="form-control" id="registerPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                    <div id="registerMessage" class="mt-3"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<? else : include 'sidebar.php';?>
<div class="content-page">
	<div class="content">
		<div class="container-fluid p-3">
			<?php
				$page = $_GET['page'] ?? 'profile';
				include $page . '.php';
			?>
		</div>
	</div>
</div>
<? endif; ?>
<?php include '../footer.php';?>
