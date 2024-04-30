<?php

use app\models\Article;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ArticleSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'My Blog';
$this->params['breadcrumbs'][] = $this->title;


?>

<main id="main">

    <!-- ======= Hero Slider Section ======= -->
    <section id="hero-slider" class="hero-slider">
        <div class="container-md" data-aos="fade-in">
            <div class="row">
                <div class="col-12">
                    <div class="swiper sliderFeaturedPosts">
                        <div class="swiper-wrapper">


                            <div class="swiper-slide">
                                <div class="img-bg d-flex align-items-end" style="background-image: url('assets/img/post-slide-2.jpg'); position: relative;">
                                    <div class="img-bg-inner">
                                        <h2 style="font-size: 60px;">Start Reading it's free!</h2>
                                        <!-- Button with onclick event to scroll to posts section -->
                                        <button onclick="scrollToPosts()" class="btn btn-primary" style="position: absolute; bottom: 14px; left: 42%; transform: translateX(-50%); padding: 8px 20px; font-size: 20px;cursor: pointer;">Start reading</button>
                                    </div>
                                </div>
                            </div>

                            <script>
                                function scrollToPosts() {
                                    // Scroll to the "posts" section
                                    document.getElementById('posts').scrollIntoView({ behavior: 'smooth' });
                                }
                            </script>


                            <div class="swiper-slide">
                                <a href="<?= Yii::$app->urlManager->createUrl(['/site/signup']) ?>" class="img-bg d-flex align-items-end" style="background-image: url('assets/img/post-slide-1.jpg');">
                                    <div class="img-bg-inner">
                                        <h2 style="font-size: 60px;">Signup to share your stories with the world</h2>
                                    </div>
                                </a>
                            </div>

                            <div class="swiper-slide">
                                <div class="img-bg d-flex align-items-end" style="background-image: url('assets/img/post-slide-4.jpg');">
                                    <div class="img-bg-inner">
                                        <h2 style="font-size: 80px;">Stay Curious</h2>
                                        <p>Discover stories, thinking and expertise from writers on any topic</p>

                                    </div>
                                </div>
                            </div>


                        </div>


                        <div class="custom-swiper-button-next">
                            <span class="bi-chevron-right"></span>
                        </div>
                        <div class="custom-swiper-button-prev">
                            <span class="bi-chevron-left"></span>
                        </div>

                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Hero Slider Section -->

    <div class="article-index">

        <?php if (!Yii::$app->user->isGuest): ?>
            <p>
            <div class="text-center">
                <?= Html::a('Create Article', ['create'], ['class' => 'btn btn-primary btn-lg']) ?>
            </div>
            </p>

        <?php endif; ?>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    </div>
    <!-- ======= Post Grid Section ======= -->
    <section id="posts" class="posts">
        <div class="container" data-aos="fade-up">
            <div class="row g-5">
                <?php foreach ($dataProvider->getModels() as $model): ?>
                    <div class="col-lg-4">
                        <div class="post-entry-1 lg">

                            <h2><a href="<?php echo \yii\helpers\Url::to(["/article/view", 'slug' => $model ->slug]) ?>"><?= $model->title ?></a></h2>

                            <div class="d-flex align-items-center author">

                                <div class="name">
                                    <?= $this->render('_article_item', ['model' => $model]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div> <!-- End .row -->
        </div>
    </section> <!-- End Post Grid Section -->




</main><!-- End #main -->
