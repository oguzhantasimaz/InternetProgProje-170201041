<?php

namespace kouosl\notetaking\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use kouosl\notetaking\models\NotetakingKeywords;

class NotetakingKeywordsSearch extends NotetakingKeywords
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['not_id'], 'integer'],
            [['key'], 'safe'],
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
        $query = NotetakingKeywords::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'not_id' => $this->not_id,
        ]);

        $query->andFilterWhere(['like', 'key', $this->key]);

        return $dataProvider;
    }

    public function search3($params,$notid)
    {
        // $query = NotetakingKeywords::find()
        //    ->joinWith(['not'])
        //    ->all();
        
           $query = (new \yii\db\Query())
            ->from('notetaking_keywords as tb1')
            ->leftJoin('notetaking_notes as tb2', 'tb1.not_id = tb2.id');
        

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        if (Yii::$app->user->can('seeAllNotes')){
        $query->andFilterWhere([
            'not_id' => $notid,
        ]);}else{
            $query->andFilterWhere([
                'not_id' => $notid,
                'user_id'=>Yii::$app->user->getId(),
            ]);

        }
        $query->andFilterWhere(['like', 'key', $this->key]);

        return $dataProvider;
    }
    public function search4($params,$notid)
    {
        // $query = NotetakingKeywords::find()
        //    ->joinWith(['not'])
        //    ->all();
           $query = (new \yii\db\Query())
            ->from('notetaking_keywords as tb1')
            ->leftJoin('notetaking_notes as tb2', 'tb1.not_id = tb2.id');
        

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'not_id' => $notid,
        ]);
        $query->andFilterWhere(['like', 'key', $this->key]);

        return $dataProvider;
    }
   

    public function search2($params,$notid)
    {
        $query = NotetakingKeywords::find();
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $query->andFilterWhere([
            'not_id' => $notid,
        ]);
        $query->andFilterWhere(['like', 'key', $this->key]);
        return $dataProvider;
    }

}
