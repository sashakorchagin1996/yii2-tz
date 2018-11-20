<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Books;

/**
 * BooksSearch represents the model behind the search form of `frontend\models\Books`.
 */
class BooksSearch extends Books
{
    public $autor_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'autor_id', 'edition', 'genre_id'], 'integer'],
            [['name'], 'safe'],
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
        $query = Books::find()->select('books.id,books.name ,autor_id,edition,genre_id,autor.name as autor_name')->innerJoin(Autor::tableName(),'books.autor_id=autor.id');

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
            'id' => $this->id,
            'autor_id' => $this->autor_id,
            'edition' => $this->edition,
            'genre_id' => $this->genre_id,
        ]);

        $query->andFilterWhere(['like', 'books.name', $this->name]);

        return $dataProvider;
    }
}
