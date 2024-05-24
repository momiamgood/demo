<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $user_id
 * @property string|null $date
 * @property string|null $car
 * @property int|null $status
 *
 * @property User $user
 */
class Application extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status'], 'integer'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['title', 'car'], 'string', 'max' => 255],
            [['user_id'], 'default', 'value' => Yii::$app->user->identity->id],
            [['status'], 'default', 'value' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'user_id' => 'User ID',
            'date' => 'Date',
            'car' => 'Car',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }


    public function beforeSave($insert)
    {
        switch ($this->status){
            case "Новая":
                $this->status = 1;
                break;
            case "Принята":
                $this->status = 2;
                break;
            case "Отклонена":
                $this->status = 3;
        }

        return parent::beforeSave($insert);
    }
}
