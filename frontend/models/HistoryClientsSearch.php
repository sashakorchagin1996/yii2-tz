<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\HistoryClients;

/**
 * HistoryClientsSearch represents the model behind the search form of `frontend\models\HistoryClients`.
 */
class HistoryClientsSearch extends HistoryClients
{
    public $autor_name;
    public $user_name;
    public $book_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','status_book', 'id_client', 'id_book'], 'integer'],
            [['date', 'date_end'], 'safe'],
            [['autor_name'], 'string', 'max' => 255],

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
        $this->load($params);

        if($this->autor_name){
            $query = HistoryClients::find()->select('history_clients.id as id,status_book,id_client,id_book,date,date_end,autor.name as autor_name,books.name as book_name,user.username as user_name')
                ->innerJoin(Books::tableName(),'books.id=history_clients.id_book')
                ->innerJoin(Autor::tableName(),'books.autor_id=autor.id and autor.id = '.$this->autor_name)
                ->innerJoin(User::tableName(),'user.id=history_clients.id_client');
        } else {

        $query = HistoryClients::find()->select('history_clients.id as id,status_book,id_client,id_book,date,date_end,autor.name as autor_name,books.name as book_name,user.username as user_name')
            ->innerJoin(Books::tableName(),'books.id=history_clients.id_book')
            ->innerJoin(Autor::tableName(),'books.autor_id=autor.id')
            ->innerJoin(User::tableName(),'user.id=history_clients.id_client');
        }

//
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_client' => $this->id_client,
            'id_book' => $this->id_book,
            'date' => $this->date,
            'date_end' => $this->date_end,
            'status_book' => $this->status_book,

        ]);

        return $dataProvider;
    }
    public function searchHistory($params)
    {
        $this->load($params);

        if($this->autor_name){
            $query = HistoryClients::find()->select('history_clients.id as id,status_book,id_client,id_book,date,date_end,autor.name as autor_name,books.name as book_name,user.username as user_name')
                ->where(['id_client'=>Yii::$app->user->identity->getId()])
                ->innerJoin(Books::tableName(),'books.id=history_clients.id_book')
                ->innerJoin(Autor::tableName(),'books.autor_id=autor.id and autor.id = '.$this->autor_name)
                ->innerJoin(User::tableName(),'user.id=history_clients.id_client');
        } else {

        $query = HistoryClients::find()->select('history_clients.id as id,status_book,id_client,id_book,date,date_end,autor.name as autor_name,books.name as book_name,user.username as user_name')
            ->where(['id_client'=>Yii::$app->user->identity->getId()])
            ->innerJoin(Books::tableName(),'books.id=history_clients.id_book')
            ->innerJoin(Autor::tableName(),'books.autor_id=autor.id')
            ->innerJoin(User::tableName(),'user.id=history_clients.id_client');
        }

//
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_client' => $this->id_client,
            'id_book' => $this->id_book,
            'date' => $this->date,
            'date_end' => $this->date_end,
            'status_book' => $this->status_book,

        ]);

        return $dataProvider;
    }
}
