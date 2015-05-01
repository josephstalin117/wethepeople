<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "{{%suggestion}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $submitter
 * @property integer $status
 * @property integer $up
 * @property integer $down
 * @property string $part
 * @property integer $created_at
 * @property integer $updated_at
 */
class Suggestion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%suggestion}}';
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    Yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    Yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'submitter'], 'required'],
            [['content', 'part'], 'string'],
            [['submitter', 'status', 'up', 'down'], 'integer'],
            [['title'], 'string', 'max' => 255]
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
            'content' => Yii::t('app', 'Content'),
            'submitter' => Yii::t('app', 'Submitter'),
            'status' => Yii::t('app', 'Status'),
            'up' => Yii::t('app', 'Up'),
            'down' => Yii::t('app', 'Down'),
            'part' => Yii::t('app', 'Part'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
