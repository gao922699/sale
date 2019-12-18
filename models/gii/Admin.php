<?php

namespace app\models\gii;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property int $id
 * @property string $username 用户名
 * @property string $password 密码
 * @property string|null $authKey authKey
 * @property string|null $accessToken accessToken
 * @property string|null $province 省份
 * @property string|null $city 城市
 * @property string|null $address 地址
 * @property string|null $tel 联系方式
 * @property string|null $contact 联系人
 * @property int $role 角色
 * @property int $status 状态
 * @property string|null $created_at 创建时间
 * @property string|null $updated_at 更新时间
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'role', 'status'], 'required'],
            [['role', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['username', 'password', 'authKey', 'accessToken', 'province', 'city', 'address', 'tel', 'contact'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'password' => '密码',
            'authKey' => 'authKey',
            'accessToken' => 'accessToken',
            'province' => '省份',
            'city' => '城市',
            'address' => '地址',
            'tel' => '联系方式',
            'contact' => '联系人',
            'role' => '角色',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
        ];
    }

    /**
     * {@inheritdoc}
     * @return AdminQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AdminQuery(get_called_class());
    }
}
