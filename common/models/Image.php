<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property string $filename
 * @property integer $item_id
 * @property integer $is_main
 * @property string $model_name
 * @property string $title
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'is_main'], 'integer'],
            [['filename', 'model_name', 'title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'filename' => Yii::t('app', 'Filename'),
            'item_id' => Yii::t('app', 'Item ID'),
            'is_main' => Yii::t('app', 'Is Main'),
            'model_name' => Yii::t('app', 'Model Name'),
            'title' => Yii::t('app', 'Title'),
        ];
    }

    public function getImage()
    {
        $image =  ($this->filename) ? $this->filename : 'placeholder.jpg';
        return Yii::getAlias('@frontendWebroot/images').'/'.$image;
    }

    public function getImagePath()
    {
        $image =  ($this->filename) ? $this->filename : 'placeholder.jpg';
        return '@frontend/web/images/'.$image;
    }




}
