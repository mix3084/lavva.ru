<?php
	$title = "Отзывы";
	$description = "Отзывы о наших курсах";

	include '../header.php';
?>
<!-- shapppa Start -->
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">Отзывы</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="/">Главная</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Отзывы</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!--End -->

<!-- отзыв Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="text-center">
            <h1 class="mb-5">Студенты пишут о нас!</h1>
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
<!-- End -->
<?php include '../footer.php';?>