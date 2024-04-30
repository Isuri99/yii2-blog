<?php

namespace app\models;

use http\Url;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Html;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 *
 * @property User $createdBy
 */
class Article extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * {@inheritdoc}
     *
     */



    public static function tableName()
    {
        return 'article';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,  //BlameableBehavior- who created and who updated the document
                'updatedByAttribute' => false  //because there is no updateby attribute in our database
            ],
            [
                'class' => SluggableBehavior::class, //SluggableBehavior - take one field and convert it into a slug(here slug is generated from the title
                'attribute' => 'title'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'body'], 'required'],
            [['body'], 'string'],
            [['created_at', 'updated_at', 'created_by'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 1024],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['image'], 'file', 'extensions'=>'jpg,png'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'body' => 'Body',
            'image'=> 'Upload Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',

        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);  //many-one relation
    }

    public function getEncodedBody()
    {

       return Html::encode($this->body);
    }



}
