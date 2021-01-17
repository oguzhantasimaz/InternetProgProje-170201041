<?php

namespace kouosl\notetaking\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use kouosl\notetaking\models\NotetakingNotes;

class NotetakingNotesSearch extends NotetakingNotes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'id'], 'integer'],
            [['title', 'content'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = NotetakingNotes::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(Yii::$app->user->can('seeAllNotes')){
            $query->andFilterWhere([
                'user_id' => $this->user_id ,
                'id' => $this->id,
            ]);
        }else{
        $query->andFilterWhere([
            'user_id' => Yii::$app->user->getId() ,
            'id' => $this->id,
        ]);}

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }

    public function search2($params)
    {
        $query = (new \yii\db\Query())
            ->from('notetaking_notes as tb1')
            ->where(['status'=>1]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $dataProvider;
    }
}
