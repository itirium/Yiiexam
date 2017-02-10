<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "item".
 *
 * @property integer $id
 * @property string $name
 * @property double $price
 * @property string $description
 * @property string $imagesrc
 *
 * @property Backet[] $backets
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $file;


    public static function tableName()
    {
        return 'item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['name', 'description', 'imagesrc'], 'string', 'max' => 255],
            [['file'],'file']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Товар',
            'price' => 'Ціна',
            'description' => 'Опис',
            'imagesrc' => 'Зображення',
            'file' => 'Файл зображення',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBackets()
    {
        return $this->hasMany(Backet::className(), ['item_id' => 'id']);
    }
    
    public  function getInfoItemBy($id){
        $data= Item::find()->asArray()->where('id=:id',['id'=>$id])->one();
        return $data;
    }
}
