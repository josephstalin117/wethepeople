<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%upload_file}}".
 *
 * @property integer $id
 * @property string $path
 * @property string $mime_type
 * @property string $created_at
 * @property string $user_id
 */
class UploadFile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%upload_file}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['path', 'mime_type', 'user_id'], 'required'],
            [['created_at', 'user_id'], 'integer'],
            [['path'], 'string', 'max' => 1024],
            [['mime_type'], 'string', 'max' => 255]
        ];
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
                ],
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
            'name' => Yii::t('app', '文件名'),
            'path' => Yii::t('app', 'Path'),
            'mime_type' => Yii::t('app', 'Mime Type'),
            'created_at' => Yii::t('app', 'Created At'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }
}
