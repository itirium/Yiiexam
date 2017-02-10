<?php

namespace app\models;

use app\models\Post;

use yii\base\Model;
use yii;

class Postchat extends Model
{
     public $post;
    

public function rules()
    {
        return [
            [['post'], 'required'],
            [['post'], 'string', 'max' => 200]            
        ];
    }

    
    public function postchat() 
    {
        
     $post=new Post();
     $post->userid = Yii::$app->user->identity->id;
//     $chat->username = Yii::$app->user->identity->username;
     $post->message = $this->post;
     $post->messagedt = '';
     return $post->save();        
    }
    
    
}