<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $dt_add
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $contacts
 *
 * @property Bets[] $bets
 * @property Lots[] $lots
 * @property Lots[] $lots0
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface
{
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dt_add', 'name', 'email', 'password', 'contacts'], 'required'],
            [['dt_add'], 'safe'],
            [['name', 'email', 'password', 'contacts'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dt_add' => 'Dt Add',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'contacts' => 'Contacts',
        ];
    }

    /**
     * Gets query for [[Bets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBets()
    {
        return $this->hasMany(Bets::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Lots]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLots()
    {
        return $this->hasMany(Lots::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Lots0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLots0()
    {
        return $this->hasMany(Lots::className(), ['winner_id' => 'id']);
    }

    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }
}
