<?php

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class BacketWidget extends Widget{
 
    public function init(){
        parent::init();
    }
    
    public function run(){
        return $this->render('backet');
    }
}