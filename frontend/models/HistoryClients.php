<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "history_clients".
 *
 * @property int $id
 * @property int $id_client
 * @property int $id_book
 * @property string $date
 * @property string $date_end
 * @property int $status_book
 *
 * @property Books $book
 * @property User $client
 */
class HistoryClients extends \yii\db\ActiveRecord
{
    public $book_name;
    public $autor_name;
    public $user_name;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'history_clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_client', 'id_book', 'date', 'date_end'], 'required'],
            [['id_client', 'id_book','status_book'], 'integer'],
            [['date', 'date_end'], 'safe'],
            [['id_book'], 'exist', 'skipOnError' => true, 'targetClass' => Books::className(), 'targetAttribute' => ['id_book' => 'id']],
            [['id_client'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_client' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_client' => 'Id Client',
            'id_book' => 'Id Book',
            'date' => 'Date',
            'date_end' => 'Date End',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Books::className(), ['id' => 'id_book']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(User::className(), ['id' => 'id_client']);
    }
}
