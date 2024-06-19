<?php
	$title = "404 - Страница не найдена";
	$description = "Извините, страница не найдена.";
	include 'header.php';
?>
<!-- шапка Start -->
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">Не смотреть</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="/">Главная</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">та самая ошибка</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- End -->


<!-- Ошибка Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <i class="bi bi-exclamation-triangle display-1 text-primary"></i>
                <h1 class="display-1">404</h1>
                <h1 class="mb-4">Not Found</h1>
                <p class="mb-4">Извините, но зачем вам сюда нужно? давайте пропустим эту страницу, спасибо за понимание!</p>
                <a class="btn btn-primary rounded-pill py-3 px-5" href="/">Вернуться на главную</a>
            </div>
        </div>
    </div>
</div>
<!-- 404 End -->
<?php include 'footer.php';?>