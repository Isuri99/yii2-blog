<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= Html::encode($this->title) ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">

    <!-- Template Main CSS Files -->
    <link href="assets/css/variables.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: ZenBlog
    * Template URL: https://bootstrapmade.com/zenblog-bootstrap-blog-template/
    * Updated: Mar 17 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https:///bootstrapmade.com/license/
    ======================================================== -->
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>
<!-- ======= Header ======= -->
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">


            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <a class="navbar-brand logo_h" href="<?= Yii::$app->homeUrl ?>"><h1>My Blog</h1></a>


        <nav id="navbar" class="navbar">
            <ul>
                <li class="nav-item active"><a class="nav-link" href="<?= Yii::$app->homeUrl ?>">Home</a></li>
                <?php if (Yii::$app->user->isGuest): ?>

                    <li class="nav-item"><a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['/site/login']) ?>">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= Yii::$app->urlManager->createUrl(['/site/signup']) ?>">Signup</a></li>
                <?php else: ?>
                <li class="nav-item">
                    <?= Html::beginForm(['/site/logout'], 'post') ?>
                    <?= Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'nav-link btn btn-link logout mx-5']
                    ) ?>
                    <?= Html::endForm() ?>
                    <?php endif; ?>
                </li>
            </ul>
        </nav><!-- .navbar -->

        <div class="position-relative">
            <a href="#" class="mx-2"><span class="bi-facebook"></span></a>
            <a href="#" class="mx-2"><span class="bi-twitter"></span></a>
            <a href="#" class="mx-2"><span class="bi-instagram"></span></a>

            <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
            <i class="bi bi-list mobile-nav-toggle"></i>

            <!-- ======= Search Form ======= -->
            <div class="search-form-wrap js-search-form-wrap">
                <form action="search-result.html" class="search-form">
                    <span class="icon bi-search"></span>
                    <input type="text" placeholder="Search" class="form-control">
                    <button class="btn js-search-close"><span class="bi-x"></span></button>
                </form>
            </div><!-- End Search Form -->

        </div>

    </div>


</header><!-- End Header -->

<div class="container">
    <?= $content ?>
</div>

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

    <div class="footer-content">
        <div class="container">

            <div class="row g-5">
                <div class="col-lg-4">
                    <h3 class="footer-heading">About My Blog</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam ab, perspiciatis beatae autem deleniti voluptate nulla a dolores, exercitationem eveniet libero laudantium recusandae officiis qui aliquid blanditiis omnis quae. Explicabo?</p>
                </div>

                <div class="col-6 col-lg-2">
                    <h3 class="footer-heading">Navigation</h3>
                    <ul class="footer-links list-unstyled">
                        <li><a href="<?= Yii::$app->homeUrl ?>"><i class="bi bi-chevron-right"></i> Home</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/site/login']) ?>"><i class="bi bi-chevron-right"></i>Login</a></li>
                        <li><a href="<?= Yii::$app->urlManager->createUrl(['/site/signup'])?>"><i class="bi bi-chevron-right"></i>Signup </a> </li>
                    </ul>
                </div>


                <div class="footer-legal">
                    <div class="container">

                        <div class="row justify-content-between">
                            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                                <div class="copyright">
                                    © Copyright <strong><span>My Blog</span></strong>. All Rights Reserved
                                </div>

                                <div class="credits">
                                    <!-- All the links in the footer should remain intact. -->
                                    <!-- You can delete the links only if you purchased the pro version. -->
                                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
                                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                                </div>

                            </div>



                        </div>

                    </div>

                </div>
            </div>

</footer>


<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>