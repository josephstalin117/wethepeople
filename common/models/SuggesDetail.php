<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%sugges_detail}}".
 *
 * @property integer $id
 * @property integer $sugg_id
 * @property string $part_id
 * @property integer $attitude
 */
class SuggesDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sugges_detail}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sugg_id'], 'required'],
            [['sugg_id', 'attitude'], 'integer'],
            [['part_id'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sugg_id' => Yii::t('app', 'Sugg ID'),
            'part_id' => Yii::t('app', 'Part ID'),
            'attitude' => Yii::t('app', 'Attitude'),
        ];
    }
}
