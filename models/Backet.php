<?php

namespace app\models;

use Yii;

use yii\db\Query;

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
            'count' => 'Кількість',
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
        
        $cart =($cart=Backet::find()->where(['user_id'=>Yii::$app->user->id,'item_id'=>$item_id])->one())?$cart:new Backet();
        $cart->user_id = Yii::$app->user->id;
        $cart->item_id =$item_id;
        $cart->count+=1;
        $cart->save();
        //return ($cart->save())?true:false;
    }
    public function  addToBacketCart($item_id,$item_count)
    {
        
        $cart =($cart=Backet::find()->where(['user_id'=>Yii::$app->user->id,'item_id'=>$item_id])->one())?$cart:new Backet();
        $cart->user_id = Yii::$app->user->id;
        $cart->item_id =$item_id;
        $cart->count+=$item_count;
        //$cart->save();
        return ($cart->save())?true:false;
    }
    public static function getCartQuery($userid){
      $query=new Query();
        $query->select('*')
         ->from ([Backet::tableName()])
         ->leftJoin(Item::tableName(),'id=item_id')
         ->where(['user_id'=>':uid'],[':uid'=>$userid])
                ->all();
        return $query;
    }
    
       
    
}
