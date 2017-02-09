<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="img/brand.png" height="30px"/>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-inverse navbar-fixed-top',
            'renderInnerContainer'=>false
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Магазин', 'url' => ['/site/index']],
            ['label' => 'Доставка і оплата', 'url' => ['/site/about']],
            ['label' => 'Зворотній зв`язок', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                    ['label'=>'Реєстрація', 'url'=>['/user/reg']]
                    ):(''),
            
            Yii::$app->user->isGuest ? (
                ['label' => 'Вхід', 'url' => ['/user/login']]
            ) : (   
                    [
                        'label'=>Yii::$app->user->identity['username'],
                        'url'=>'',                        
                        'items'=>
                        [
                            ['label' => '<span>&nbsp</span>','encode'=>false],                            
                            ['label'=>'Профіль',
                                'url'=>['/user/profile'],
                                'linkOptions'=>['data-method'=>'post']],
                            ['label' => '<span>&nbsp</span>','encode'=>false],
                            Yii::$app->user->identity['ismanager']?(                           
                                ['label'=>'Редагувати товар',
                                'url'=>['/item/index'],
                                'linkOptions'=>['data-method'=>'post']
                            ]):(''),
                            Yii::$app->user->identity['ismanager']?(                           
                                ['label'=>'Керування користувачами',
                                'url'=>['/user/managers'],
                                'linkOptions'=>['data-method'=>'post']
                            ]):(''),
                            ['label' => '<span>&nbsp</span>','encode'=>false],
                            ['label'=>'Вихід',
                                'url'=>['/user/logout'],
                                'linkOptions'=>['data-method'=>'post']]
                        ]
                    ]
                )            
        ],
    ]);
    NavBar::end();
    ?>
 
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div> 
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Paracordium.ua <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?> і виплакано потом мною))</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
