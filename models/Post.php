<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $post
 * @property string $created_at
 * @property integer $user_id
 *
 * @property User $user
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post'], 'string'],
            [['user_id'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post' => 'Post',
            'created_at' => 'Created At',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    public function InsertPost($mess){
        $post = new Post();            
        //$string = 'test';
                //Yii::$app->request->post('string');        
       // if (!is_null($string)) {         
            $post->user_id = Yii::$app->user->identity->id;
            $post->post = $mess;
            $post->created_at = date("Y-m-d H:i:s");
           // $post->save();                   
        return $post->save();       
    }
    
}
