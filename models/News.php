<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property string $id
 * @property string $author_id
 * @property string $title
 * @property string $content
 * @property string $d_create
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id'], 'integer'],
            [['title'], 'required'],
            [['content'], 'string'],
            [['d_create'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'author_id' => Yii::t('app', 'Author ID'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'd_create' => Yii::t('app', 'D Create'),
        ];
    }
}
