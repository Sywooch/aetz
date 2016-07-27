<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use Yii\db\ActiveRecord;
use vova07\fileapi\behaviors\UploadBehavior;
use yii\behaviors\SluggableBehavior;
use yii\web\UploadedFile;
use himiklab\sortablegrid\SortableGridBehavior;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $photo
 * @property string $slug
 * @property integer $category_id
 * @property string $description
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property integer $is_published
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'is_published', 'created', 'updated', 'created_user_id', 'updated_user_id',], 'integer'],
            [['description'], 'string'],
            [['title', 'photo', 'slug', 'meta_title', 'meta_keywords', 'meta_description'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created', 'updated'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated'],
                ],
            ],
            'uploadBehavior' => [
                'class' => UploadBehavior::className(),
                'attributes' => [
                    'photo' => [
                        'path' => '@frontend/web/images',
                        'tempPath' => '@frontend/web/images',
                        'url' => Yii::getAlias('@frontendWebroot/images')
                    ],
                ]
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'slug'
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_user_id',
                'updatedByAttribute' => 'updated_user_id',
            ],
        ];

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'photo' => Yii::t('app', 'Photo'),
            'slug' => Yii::t('app', 'Slug'),
            'category_id' => Yii::t('app', 'Category ID'),
            'description' => Yii::t('app', 'Description'),
            'meta_title' => Yii::t('app', 'Meta Title'),
            'meta_keywords' => Yii::t('app', 'Meta Keywords'),
            'meta_description' => Yii::t('app', 'Meta Description'),
            'is_published' => Yii::t('app', 'Is Published'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
            'created_user_id' => Yii::t('app', 'Created User Id'),
            'updated_user_id' => Yii::t('app', 'Updated User Id'),
        ];
    }

    public function getImages()
    {
        return Image::find()->where(['model_name' => 'product','item_id' => $this->id])->all();
    }

    public function getImage()
    {
        $image =  ($this->photo) ? $this->photo : 'placeholder.jpg';

        return Yii::getAlias('@frontendWebroot/images/').$image;
    }

    public function getImagePath()
    {
        $image =  ($this->photo) ? $this->photo : 'placeholder.jpg';
        return '@frontend/web/images/'.$image;
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }


}
