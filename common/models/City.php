<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gg_city".
 *
 * @property integer $id
 * @property integer $country_id
 * @property string $title
 * @property integer $is_published
 */
class City extends \yii\db\ActiveRecord
{
    const CITY_ALMATY = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%city}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id', 'is_published'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['latitude', 'longitude'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'country_id' => Yii::t('app', 'Country ID'),
            'title' => Yii::t('app', 'Title'),
            'is_published' => Yii::t('app', 'Is Published'),
        ];
    }

    public static function getDefaultCity(){

        $city_id = City::findOne(CITY::CITY_ALMATY);

        if (Yii::$app->getSession()->get('city_id') >= 0) {
            $city_id = Yii::$app->session->get('city_id');
        } else if (!Yii::$app->user->isGuest) {
            $user = User::findOne(Yii::$app->user->id);
            if ($user->city->id > 0) {
                $city_id = $user->city->id;
            }
        }

        return $city_id;
    }
}
