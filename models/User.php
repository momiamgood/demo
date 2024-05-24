<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $phone
 * @property string|null $password
 * @property string|null $email
 * @property string|null $full_name
 * @property int|null $role
 * @property string|null $car_data
 *
 * @property Application[] $applications
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $password_check;
    public $check;

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

        /**
         *
         * Роли
         * 1-user
         * 2-admin
         *
         *
         */


        return [
            [['full_name', 'password', 'email', 'phone', 'car_data'], 'required'],
            [['role'], 'integer'],
            [['phone', 'password', 'email', 'full_name', 'car_data'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['email'], 'unique'],
            ['full_name', 'match', 'pattern' => '/^[А-я -ё]*$/u'],
            [['password'], 'string', 'min' => 3],
            [['password'], 'match', 'pattern' => '/^[a-z1-9]\w*$/i'],
            [['role'], 'default', 'value' => 1],
            ['password_check', 'compare', 'compareAttribute' => 'password'],
            ['check', 'compare', 'compareValue' => 1]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Номер телефона',
            'password' => 'Пароль',
            'email' => 'Email',
            'full_name' => 'ФИО',
            'role' => 'Role',
            'car_data' => 'Серия и номер водительского удостоверения',
            'password_check' => 'Повтор пароля',
            'check' => 'Согласие на обработку персональных данных'
        ];
    }

    /**
     * Gets query for [[Applications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(Application::class, ['user_id' => 'id']);
    }


    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null current user auth key
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * @param string $authKey
     * @return bool|null if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return null;
    }

    public static function findByEmail($email)
    {
        return User::findOne(['email' => $email]);
    }

    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    public function beforeSave($insert){
        $this->password = md5($this->password);
        return parent::beforeSave($insert);
    }

    public function isAdmin()
    {
        return $this->role === 2;
    }
}
