<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

class Admin extends \app\models\gii\Admin implements \yii\web\IdentityInterface
{

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => date('Y-m-d H:i:s')
            ],
        ];
    }

    const ROLE_ADMIN = 1;
    const ROLE_GOODS_ADMIN = 2;
    const ROLE_SUPPLIER = 3;

    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    public static $roleTxtMap = [
        self::ROLE_ADMIN => '总管理员',
        self::ROLE_GOODS_ADMIN => '商品管理员',
        self::ROLE_SUPPLIER => '供应商',
    ];

    public static $statusTxtMap = [
        self::STATUS_ACTIVE => '正常',
        self::STATUS_DELETED => '禁用',
    ];

    public $confirmPassword = '';

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
        return static::findOne(['username' => $username, 'status' => Admin::STATUS_ACTIVE]);
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

    /**
     * @return array
     */
    public static function getSuppliers()
    {
        $admins = self::find()->where(['role' => self::ROLE_SUPPLIER])->active()->all();
        return ArrayHelper::map($admins, 'id', 'username');
    }

    public static function isAdmin()
    {
        if (Yii::$app->admin->identity->role == self::ROLE_ADMIN) {
            return true;
        }
        return false;
    }

    public static function isGoodsAdmin()
    {
        if (Yii::$app->admin->identity->role == self::ROLE_GOODS_ADMIN) {
            return true;
        }
        return false;
    }

    public static function isSupplier()
    {
        if (Yii::$app->admin->identity->role == self::ROLE_SUPPLIER) {
            return true;
        }
        return false;
    }
}
