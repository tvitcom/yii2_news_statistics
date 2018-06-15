<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "click".
 *
 * @property string $id
 * @property string $news_id
 * @property string $unique_cnt
 * @property string $cnt
 * @property string $country_code
 * @property string $date_of
 */
class Click extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'click';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['news_id', 'unique_cnt', 'cnt'], 'integer'],
            [['date_of'], 'safe'],
            [['country_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'news_id' => Yii::t('app', 'News ID'),
            'unique_cnt' => Yii::t('app', 'Unique Cnt'),
            'cnt' => Yii::t('app', 'Cnt'),
            'country_code' => Yii::t('app', 'Country Code'),
            'date_of' => Yii::t('app', 'Date Of'),
        ];
    }
}
