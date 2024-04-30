<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Article $model */


$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class ="container"
<div class="article-view" style="padding-top: 100px;">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="text-muted">

        <small>Created At:<b> <?php echo Yii::$app->formatter->asRelativeTime($model->created_at)?> </b>

            By: <b> <?php echo $model->createdBy->username ?></b>

        </small>


    </p>


    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?php //added an if condition to do the same thing for buttons as did to the update action
            if(\Yii::$app->user->can('updatePost', ['article'=>$model]) ){

                echo Html::a('Update', ['update', 'slug' => $model->slug], ['class' => 'btn btn-primary']);

            }
            ?>

            <?php
            if (\Yii::$app->user->can('deletePost', ['article'=>$model])){
                echo Html::a('Delete', ['delete', 'slug' => $model->slug], [
                    'class' => 'btn btn-danger',

                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]);
            }
            ?>

        </p>


    <?php endif; ?>

    <div>

        <?php
        // Check if image data exists in the model's 'image' attribute
        if ($model->image !== null) {
            // Use Html::img() helper to display the image
            echo Html::img($model->image, ['alt' => $model->title, 'width' => 500, 'height' => 300, 'style' => 'display: block; margin-left: auto; margin-right: auto;',]);
        } else {
            // Handle case where image is not available (optional)
            echo 'No image available';
        }
        ?>

    </div>


    <div style="padding-top: 40px;">


        <div>
            <?php echo $model->getEncodedBody(); ?>

        </div>

    </div>
</div>