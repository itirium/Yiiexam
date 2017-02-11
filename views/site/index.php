<?php

/* @var $this yii\web\View */
use app\models\Item;
use yii\widgets\DetailView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use app\components\ChatWidget;
use app\components\BacketWidget;

$this->title = 'Yii Paracordium';
?>
<div class="site-index">
    <div class="row">
        <div class="col-md-2" id="chatBlock"> 
           <?= ChatWidget::widget(); ?>
        </div>
        <div class="col-md-8">
            <div class="jumbotron">
        <div id="custom-bootstrap-carousel" class="carousel slide" data-ride="carousel" data-interval="3000">
    <ol class="carousel-indicators">
        <li data-target="#custom-bootstrap-carousel" data-slide-to="0" class="active"></li>
        <li data-target="#custom-bootstrap-carousel" data-slide-to="1"></li>
        <li data-target="#custom-bootstrap-carousel" data-slide-to="2"></li>
        <li data-target="#custom-bootstrap-carousel" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner" role="listbox">        
        <div class="item active">
            <center>
            <img src="img/carousel01.jpg" alt="img1">
            </center>
        </div>
        <div class="item">
            <center>
            <img src="img/carousel02.jpg" alt="img2">
            </center>
        </div>
        <div class="item">
            <center>
            <img src="img/carousel03.jpg" alt="img3">
            </center>
        </div>
        <div class="item">   
            <center>
            <img src="img/carousel04.jpg" alt="img4"> 
            </center>
        </div>
    </div><a class="left carousel-control" href="#custom-bootstrap-carousel" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="right carousel-control"
    href="#custom-bootstrap-carousel" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only">Next</span></a>
    </div>
   </div>
     </div>
        <div class="col-md-2" id="myBlock">
            <?= BacketWidget::widget(); ?>
        </div>
    </div>
    
    <?php
    
    ?> 
    <div class="body-content">
         <div class="row text-center">
             <h4>Товари</h4>
             <?php                   
             
             $tovar = Item::find()->all();
            // var_dump($tovar); die();
             
              foreach ($tovar as $value) {
               $tmp = '<a href="#" class="btn btn-primary" onclick="addtoCart('.$value->id.')">Додати до кошика!</a>';
               $tmp2 = (Yii::$app->user->isGuest) ? '<a href="#" class="btn btn-default">Виконайте вхід</a>' : $tmp ;
               echo'<div class="col-md-3 col-sm-6">
                   <div class="thumbnail">
                    <img id="img_'.$value->id.'" src="'.$value->imagesrc .'" width="100" alt="">
                    <div class="caption">
                        <h3 id="txtItName_'.$value->id.'">'.$value->name .'</h3>
                        <p id="txtItDesc_'.$value->id.'">'.$value->description.'</p>
                        <p>
                           <b id="txtItPrice_'.$value->id.'">'.$value->price.' грн.</b> '.$tmp2.'</p>
                    </div>
                </div>
            </div>';
             }
             ?>           
         </div>
    </div>
</div>
