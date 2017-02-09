<?php

/* @var $this yii\web\View */
use app\models\Item;
use yii\widgets\DetailView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

$this->title = 'Yii Paracordium Магазин';
?>
<div class="site-index">

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

    <?php
    
    ?> 
    <div class="body-content">
         <div class="row text-center">
             <?php             
             $tovar = Item::find()->all();
            // var_dump($tovar); die();
              foreach ($tovar as $value) {
               echo'<div class="col-md-3 col-sm-6">
                   <div class="thumbnail">
                    <img src="'.$value->imagesrc .'" width="100" alt="">
                    <div class="caption">
                        <h3>'.$value->name .'</h3>
                        <p>'.$value->description.'</p>
                        <p>
                           <b>'.$value->price.' грн.</b> <a href="#" class="btn btn-primary">Додати до кошика!</a>
                        </p>
                    </div>
                </div>
            </div>';
             };
             ?>           
         </div>
    </div>
</div>
