<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'assets/vendor/bootstrap/css/bootstrap.min.css',
        'assets/vendor/bootstrap-icons/bootstrap-icons.css',
        'assets/vendor/swiper/swiper-bundle.min.css',
        'assets/vendor/glightbox/css/glightbox.min.css',
        'assets/vendor/aos/aos.css',
        'assets/css/variables.css',
        'assets/css/main.css',
        'css/site.css',

    ];
    public $js = [
        'assets/vendor/bootstrap/js/bootstrap.bundle.min.js',
        'assets/vendor/swiper/swiper-bundle.min.js',
        'assets/vendor/glightbox/js/glightbox.min.js',
        'assets/vendor/aos/aos.js',
        'assets/vendor/php-email-form/validate.js',
        'assets/js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
