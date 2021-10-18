<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lots".
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $winner_id
 * @property int $category_id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property int $price
 * @property int $step
 * @property string $dt_add
 * @property string $dt_end
 *
 * @property Bets[] $bets
 * @property Categories $category
 * @property Users $user
 * @property Users $winner
 */
class Lots extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lots';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'category_id', 'name', 'description', 'image', 'price', 'step', 'dt_add', 'dt_end'], 'required'],
            [['user_id', 'winner_id', 'category_id', 'price', 'step'], 'integer'],
            [['dt_add', 'dt_end'], 'safe'],
            [['name', 'image'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 1000],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['winner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['winner_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'winner_id' => 'Winner ID',
            'category_id' => 'Category ID',
            'name' => 'Name',
            'description' => 'Description',
            'image' => 'Image',
            'price' => 'Price',
            'step' => 'Step',
            'dt_add' => 'Dt Add',
            'dt_end' => 'Dt End',
        ];
    }

    /**
     * Gets query for [[Bets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBets()
    {
        return $this->hasMany(Bets::className(), ['lot_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Winner]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWinner()
    {
        return $this->hasOne(Users::className(), ['id' => 'winner_id']);
    }
}
