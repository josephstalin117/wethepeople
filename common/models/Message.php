<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "{{%message}}".
 *
 * @property integer $id
 * @property integer $send_id
 * @property integer $recive_id
 * @property integer $un_read
 * @property string $content
 * @property integer $created_at
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['send_id', 'recive_id'], 'required'],
            [['send_id', 'recive_id', 'un_read', 'created_at'], 'integer'],
            [['content'], 'string'],
            ['recive_id', 'validateReciveId'],
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
            'send_id' => Yii::t('app', '发送人id'),
            'recive_id' => Yii::t('app', '接受人id'),
            'un_read' => Yii::t('app', '是否'),
            'content' => Yii::t('app', '内容'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public function validateReciveId($attribute, $params)
    {
        if (!User::find()->where(['id' => $this->recive_id])->one()) {
            $this->addError($attribute, '用户名不存在');
        }
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'recive_id']);
    }

    /**
     * 返回私信列表
     * @author josephLin
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getLatestContact($userId)
    {
        //获取与用户相关的私信列表，并过滤其中的重复列
        $provider = new ActiveDataProvider([
//            'query' => static::find()->where(['send_id' => $userId])->orWhere(['recive_id' => $userId])->groupBy(['(send_id+recive_id)'])->orderBy(['created_at' => SORT_DESC])->distinct(),
            'query' => static::find()->where(['send_id' => $userId])->orWhere(['recive_id' => $userId])->orderBy(['created_at' => SORT_DESC])->distinct(),
            //@todo 每条产生的不是最新的消息内容
            'sort' => [
                'attributes' => ['created_at'],
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
//        $models = $provider->getModels();
        if ($provider) {
            return $provider;
        } else {
            return false;
        }
    }

    /**
     * 管理员获取用户的私信内容
     * @param $userId1
     * @param $userId2
     * @return array
     */
    public static function getDialogue($userId1, $userId2)
    {
        $provider = new ActiveDataProvider([
            'query' => static::find()->where(['recive_id' => $userId1, 'send_id' => $userId2])->orWhere(['send_id' => $userId1, 'recive_id' => $userId2])->orderBy(['created_at' => SORT_DESC]),
            'sort' => [
                'attributes' => ['created_at'],
                'defaultOrder' => [
                    'created_at' => SORT_DESC
                ]
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $models = $provider->getModels();
        return $models;
    }

    /**
     * 用户获取用户与其他人的的私信内容
     * @param $userId
     * @return mixed
     */
    public static function getMyDialgue($userId)
    {
        $userId1 = Yii::$app->user->id;
        $userId2 = $userId;
        $models = static::getDialogue($userId1, $userId2);
        foreach ($models as $model) {
            if ($model->is_checked == 0) {
                $model->is_checked = 1;
                $model->update();
            }
        }
        return $models;
    }
}
