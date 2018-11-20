<?php

namespace frontend\models;

use Yii;
use yii\rbac\Assignment;
use yii2mod\rbac\models\AssignmentModel;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class User extends \yii\db\ActiveRecord
{
    public $password;
    public $role;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['password'], 'string', 'max' => 255],
            [['role'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    // Получать роль пользователя 
    public function getRole($id = null)
    {
        if ($id == null) {
            $id = Yii::$app->getUser()->identity->getId();
        }
        $roleModel = Yii::$app->db
            ->createCommand("Select * from auth_assignment where user_id=" . $id)
            ->queryOne();

        return $roleModel['item_name'];
    }

    //  Получать только список клиентов 
    public function getClients()
    {
        $clients = Yii::$app->db
            ->createCommand("Select * from user INNER JOIN auth_assignment
    ON user.id = auth_assignment.user_id  where auth_assignment.item_name = 'client'")
            ->queryAll();
        return $clients;
    }
}
