<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Suggestion;
use yii\behaviors\TimestampBehavior;


/**
 * SuggestionSearche represents the model behind the search form about `common\models\Suggestion`.
 */
class SuggestionSearche extends Suggestion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'submitter', 'status', 'up', 'down', 'created_at', 'updated_at'], 'integer'],
            [['title', 'content', 'part'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Suggestion::find()->orderBy('created_at DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'submitter' => $this->submitter,
            'status' => $this->status,
            'up' => $this->up,
            'down' => $this->down,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'part', $this->part]);

        return $dataProvider;
    }
}
