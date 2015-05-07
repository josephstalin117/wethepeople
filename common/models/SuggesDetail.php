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
    const ATTITUDE_UP = 1;
    const ATTITUDE_DOWN = 0;

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
            [['part_id'], 'integer'],

            ['attitude', 'default', 'value' => self::ATTITUDE_DOWN],
            ['attitude', 'in', 'range' => [self::ATTITUDE_UP, self::ATTITUDE_DOWN]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sugg_id' => Yii::t('app', '提议ID'),
            'part_id' => Yii::t('app', '参与者ID'),
            'attitude' => Yii::t('app', '态度'),
        ];
    }

    public function attitudeLabels()
    {
        return [
            self::ATTITUDE_UP => Yii::t('app', '赞同'),
            self::ATTITUDE_DOWN => Yii::t('app', '反对'),
        ];
    }

    public function getAttitudeLabel()
    {
        return $this->attitudeLabels()[$this->attitude];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'part_id']);
    }
}
