<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

class User extends \app\models\gii\User implements \yii\web\IdentityInterface
{
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    public static $statusTxtMap = [
        self::STATUS_ACTIVE => '正常',
        self::STATUS_DELETED => '禁用',
    ];

    public $confirmPassword = '';

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => date('Y-m-d H:i:s')
            ],
        ];
    }

    public function rules()
    {
        return array_merge(parent::rules(), [
            ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => '两次输入的密码不一致'],
            ['confirmPassword', 'required']
        ]);
    }

    public function attributeLabels()
    {
        $labels = parent::attributeLabels();
        $labels['confirmPassword'] = '确认密码';
        return $labels;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

}
