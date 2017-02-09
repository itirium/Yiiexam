<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "backet".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $item_id
 * @property integer $count
 *
 * @property Item $item
 * @property User $user
 */
class Backet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'backet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'item_id', 'count'], 'integer'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
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
            'user_id' => 'User ID',
            'item_id' => 'Item ID',
            'count' => 'Count',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    public function  addTobacket($item_id)
    {
        \Yii::$app->user
//        $cart = ($cart = Backet::findOne(Yii::$app->user->id)) ? $cart : new Backet();
//        $cart->user_id = Yii::$app->user->id;
//        $cart->item_id =$item_id;
//        if($profile->save()):
//            $user = $this->user ? $this->user : User::findOne(Yii::$app->user->id);
//            $username = Yii::$app->request->post('User')['username'];
//            $user->username = isset($username) ? $username : $user->username;
//            return $user->save() ? true : false;
//        endif;
        return false;
    }
}
