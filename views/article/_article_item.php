<?php
use yii\helpers\Html;
/** @var $model \app\models\Article */
?>
<div>

</div>
<div>
    <a href="<?php echo \yii\helpers\Url::to(["/article/view", 'slug' => $model ->slug]) ?>">
        <div>
            <p class="text-muted text-right">
                <small>Created At:<b> <?php echo Yii::$app->formatter->asRelativeTime($model->created_at)?> </b>

                    By: <b> <?php echo $model->createdBy->username ?></b>

                </small>
            </p>
        </div>
        <div>
            <?php
            // Check if image data exists in the model's 'image' attribute
            if ($model->image !== null) {
                // Use Html::img() helper to display the image
                echo Html::img($model->image, ['alt' => $model->title, 'width' => 230, 'height' => 150]);
            } else {
                // Handle case where image is not available (optional)
                echo 'No image available';
            }
            ?>
        </div>
    <!--<h3><?php echo \yii\helpers\Html::encode($model->title) ?></h3> -->
    </a>

    <div>
        <?php echo \yii\helpers\StringHelper::truncateWords($model->getEncodedBody(), 40) ?>

    </div>

    <hr>
</div>
