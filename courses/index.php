<?php
	$title = "Курсы";
	$description = "Наши курсы, по все вопросам обращаться к администратору";

	include '../header.php';
?>
<!-- шапк Start -->
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">Курсы</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="#">Главная</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="#">Другие страницы</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Курсы</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- End -->

<!-- Categories Start -->
<div class="container-xxl py-5 category">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="mb-5">Курсы</h1>
        </div>
        <div class="row g-3">
            <div class="col-lg-7 col-md-6">
                <div class="row g-3">
                    <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                        <a class="position-relative d-block overflow-hidden" href="#">
                            <img class="img-fluid" src="/assets/img/cat-1.jpg" alt="">
                            <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin: 1px;">
                                <h5 class="m-0">Web Design</h5>
                                <small class="text-primary">49 Курсов</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                        <a class="position-relative d-block overflow-hidden" href="#">
                            <img class="img-fluid" src="/assets/img/cat-2.jpg" alt="">
                            <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin: 1px;">
                                <h5 class="m-0">Graphic Design</h5>
                                <small class="text-primary">98 Курсов</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                        <a class="position-relative d-block overflow-hidden" href="#">
                            <img class="img-fluid" src="/assets/img/cat-3.jpg" alt="">
                            <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin: 1px;">
                                <h5 class="m-0">Video Editing</h5>
                                <small class="text-primary">12 Курсов</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">
                <a class="position-relative d-block h-100 overflow-hidden" href="#">
                    <img class="img-fluid position-absolute w-100 h-100" src="/assets/img/cat-4.jpg" alt="" style="object-fit: cover;">
                    <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin:  1px;">
                        <h5 class="m-0">Online Marketing</h5>
                        <small class="text-primary">32 Курсов</small>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- утв -->

<!-- курсы Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="mb-5">Наши популярные курсы</h1>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="course-item bg-light">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid" src="/assets/img/course-1.jpg" alt="">
                        <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                            <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Read More</a>
                            <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Join Now</a>
                        </div>
                    </div>
                    <div class="text-center p-4 pb-0">
                        <h3 class="mb-0">1.500руб</h3>
                        <div class="mb-3">
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small>(673)</small>
                        </div>
                        <h5 class="mb-4">Веб дизайн для начинающих</h5>
                    </div>
                    <div class="d-flex border-top">
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>Иван Чай</small>
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>2ч/занятие</small>
                        <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>26 студентов</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="course-item bg-light">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid" src="/assets/img/course-2.jpg" alt="">
                        <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                            <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Подробнее</a>
                            <a href="/client/" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Зарегистрироваться</a>
                        </div>
                    </div>
                    <div class="text-center p-4 pb-0">
                        <h3 class="mb-0">1.500руб</h3>
                        <div class="mb-3">
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small>(813)</small>
                        </div>
                        <h5 class="mb-4">Программирование и код</h5>
                    </div>
                    <div class="d-flex border-top">
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>Владимир Гринфилд</small>
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>2ч/занятие</small>
                        <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>45 студентов</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="course-item bg-light">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid" src="/assets/img/course-3.jpg" alt="">
                        <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                            <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Подробнее</a>
                            <a href="/client/" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Зарегистрироваться</a>
                        </div>
                    </div>
                    <div class="text-center p-4 pb-0">
                        <h3 class="mb-0">2.000руб</h3>
                        <div class="mb-3">
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small>(404)</small>
                        </div>
                        <h5 class="mb-4">маркетинг и тд.</h5>
                    </div>
                    <div class="d-flex border-top">
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>Петр Павлов</small>
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>2ч/занятие</small>
                        <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>9 студентов</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End -->

<!-- отзыв Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="text-center">
            <h1 class="mb-5">студенты говорят о нас!</h1>
        </div>
        <div class="owl-carousel testimonial-carousel position-relative">
            <div class="testimonial-item text-center">
                <img class="border rounded-circle p-2 mx-auto mb-3" src="/assets/img/testimonial-1.jpg" style="width: 80px; height: 80px;">
                <h5 class="mb-0">Студент</h5>
                <p>Дизайнер</p>
                <div class="testimonial-text bg-light text-center p-4">
                <p class="mb-0">Москва входит в десять самых крупных городов мира и является самым многонаселённым городом Европы. Здесь постоянно живёт более 12 миллионов человек.</p>
                </div>
            </div>
            <div class="testimonial-item text-center">
                <img class="border rounded-circle p-2 mx-auto mb-3" src="/assets/img/testimonial-2.jpg" style="width: 80px; height: 80px;">
                <h5 class="mb-0">Студент</h5>
                <p>Дизайнер</p>
                <div class="testimonial-text bg-light text-center p-4">
                <p class="mb-0">Москва входит в десять самых крупных городов мира и является самым многонаселённым городом Европы. Здесь постоянно живёт более 12 миллионов человек.</p>
                </div>
            </div>
            <div class="testimonial-item text-center">
                <img class="border rounded-circle p-2 mx-auto mb-3" src="/assets/img/testimonial-3.jpg" style="width: 80px; height: 80px;">
                <h5 class="mb-0">Студент</h5>
                <p>Дизайнер</p>
                <div class="testimonial-text bg-light text-center p-4">
                <p class="mb-0">Москва входит в десять самых крупных городов мира и является самым многонаселённым городом Европы. Здесь постоянно живёт более 12 миллионов человек.</p>
                </div>
            </div>
            <div class="testimonial-item text-center">
                <img class="border rounded-circle p-2 mx-auto mb-3" src="/assets/img/testimonial-4.jpg" style="width: 80px; height: 80px;">
                <h5 class="mb-0">Студент</h5>
                <p>Дизайнер</p>
                <div class="testimonial-text bg-light text-center p-4">
                <p class="mb-0">Москва входит в десять самых крупных городов мира и является самым многонаселённым городом Европы. Здесь постоянно живёт более 12 миллионов человек.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End -->

<?php include '../footer.php';?>