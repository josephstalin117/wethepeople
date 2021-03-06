<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use common\models\User;


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
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

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
            [['title'], 'string', 'max' => 255],

            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE]],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', '标题'),
            'content' => Yii::t('app', '内容'),
            'submitter' => Yii::t('app', '提交人'),
            'status' => Yii::t('app', '提议状态'),
            'up' => Yii::t('app', '赞同数'),
            'down' => Yii::t('app', '反对数'),
            'part' => Yii::t('app', '参与者'),
            'created_at' => Yii::t('app', '创建时间'),
            'updated_at' => Yii::t('app', '修改时间'),
            'statusLabel' => Yii::t('app', '提议状态'),
        ];
    }

    public function statusLabels()
    {
        return [
            self::STATUS_INACTIVE => Yii::t('app', '未激活'),
            self::STATUS_ACTIVE => Yii::t('app', '激活'),
        ];
    }

    public function getStatusLabel()
    {
        return $this->statusLabels()[$this->status];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'submitter']);
    }
}
