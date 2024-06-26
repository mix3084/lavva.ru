<?php
function isActive($url) {
    return $_SERVER['REQUEST_URI'] == $url ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <title><?=$title;?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="<?=$description;?>" name="description">
    <link href="img/favicon.iсo" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="/assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet"> 
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>

<body>
    <!--  начало -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Загрузка...</span>
        </div>
    </div>
    <!--загрузочный элемент конец-->


    <!-- Верхняя стока навигации -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="/" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>lavr School</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="/" class="nav-item nav-link <?php echo isActive('/'); ?>">Главная</a>
                <a href="/about/" class="nav-item nav-link <?php echo isActive('/about/'); ?>">О нас</a>
                <a href="/courses/" class="nav-item nav-link <?php echo isActive('/courses/'); ?>">Курсы</a>
                <a href="/team/" class="nav-item nav-link <?php echo isActive('/team/'); ?>">Команда</a>
                <a href="/testimonial/" class="nav-item nav-link <?php echo isActive('/testimonial/'); ?>">Отзывы</a>
                <a href="/contact/" class="nav-item nav-link <?php echo isActive('/contact/'); ?>">Контакты</a>
            </div>
            <a href="/client/" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block <?php echo isActive('/lk/'); ?>">Личный кабинет<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </nav>
    <!--End -->

    <main>