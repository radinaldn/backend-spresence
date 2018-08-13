<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "tb_web_user".
 *
 * @property int $id_web_user
 * @property string $password
 * @property string $nama
 * @property string $level
 * @property string $created_at
 * @property string $updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    const PIMPINAN = "Pimpinan";
    const ADMINISTRATOR = "Administrator";
    const ID = 'id_web_user';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_web_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_web_user', 'password', 'nama', 'level'], 'required'],
            [['id_web_user'], 'integer'],
            [['level'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['password'], 'string', 'max' => 255],
            [['nama'], 'string', 'max' => 100],
            [['id_web_user'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_web_user' => 'Id Web User',
            'password' => 'Password',
            'nama' => 'Nama',
            'level' => 'Level',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    public function findById($id){

        $user = User::find()->where([User::ID=>$id])->one();
        if (count($user)){
            return new static($user);
        }

        return null;
    }


    public function validatePassword($password){
        return $this->password === $password;
    }


    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.
        $user = User::findOne($id);
        if(count($user)){
            return new static($user);
        }
        return null;
    }


    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        // TODO: Implement getId() method.
        return $this->id_web_user;
    }


    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
  */

    public function isPimpinan()
    {
        if ($user = User::findOne(['level' => User::PIMPINAN]))
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    public function isAdministrator()
    {
        if ($user = User::findOne(['level' => User::ADMINISTRATOR]))
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
}
