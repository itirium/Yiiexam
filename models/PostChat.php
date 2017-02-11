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

    
    public function postchat($message) 
    {        
     $post=new Post();
     $post->user_id = Yii::$app->user->identity->id;
     $post->post = $message;
     $post->created_at = new \DateTime();
     return $post->save();        
    }
    
    
}