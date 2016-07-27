<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%review}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $model_id
 * @property integer $is_published
 * @property string $review
 * @property integer $created
 * @property integer $updated
 * @property integer $deleted
 */
class Review extends \yii\db\ActiveRecord
{


    public static function tableName()
    {
        return '{{%review}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'model_id', 'is_published', 'created', 'updated'], 'integer'],
            [['review', 'model_name'], 'string'],
            ['review', 'required'],
            ['rating', 'double']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'model_id' => Yii::t('app', 'Model ID'),
            'model_name' => Yii::t('app', 'Model Name'),
            'is_published' => Yii::t('app', 'Is Published'),
            'review' => Yii::t('app', 'Review'),
            'rating' => Yii::t('app', 'Rating'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created', 'updated'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated'],
                ],
            ],
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


//    public function saveProductRating(){
//        $product = Product::findOne($this->model_id);
//
//        $reviews = Review::find()->where(['model' => 'product', 'model_id' => $this->model_id])->all();
//        $ratings = ArrayHelper::getColumn($reviews, 'rating');
//
//        $result = 0;
//        foreach($ratings as $rating){
//            $result += $rating;
//        }
//        if(count($ratings) > 0) {
//            $product->rating = ($result/count($ratings));
//            $product->save();
//        }
//    }

}
