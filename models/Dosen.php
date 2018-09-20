<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "tb_dosen".
 *
 * @property int $nip
 * @property string $password
 * @property int $imei
 * @property string $nama
 * @property string $jk
 * @property string $foto
 *
 * @property TbMengajar[] $tbMengajars
 */
class Dosen extends ActiveRecord implements IdentityInterface
{
    const NIP = 'nip';
    const PIMPINAN = 'Pimpinan';
    const ADMINISTRATOR = 'Administrator';
    const DOSEN = 'Dosen';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_dosen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nip', 'password', 'imei', 'nama', 'jk', 'foto'], 'required'],
            [['nip', 'imei'], 'integer'],
            [['jk'], 'string'],
            [['password', 'nama', 'foto'], 'string', 'max' => 255],
            [['nip', 'imei'], 'unique', 'targetAttribute' => ['nip', 'imei']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nip' => 'Nip',
            'password' => 'Password',
            'imei' => 'IMEI',
            'nama' => 'Dosen',
            'jk' => 'Jenis Kelamin',
            'foto' => 'Foto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTbMengajars()
    {
        return $this->hasMany(Mengajar::className(), ['nip' => 'nip']);
    }

    public function findByNIP($id){

        $user = Dosen::find()->where([Dosen::NIP=>$id])->one();
        if (count($user)){
            return new static($user);
        }

        return null;
    }

    public function validatePassword($password){
        return $this->password === sha1($password);
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
        $user = Dosen::findOne($id);
        if(count($user)){
            return new static($user);
        }
        return null;
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
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        // TODO: Implement getId() method.
        return $this->nip;
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

    public function isPimpinan()
    {
        if ($user = Dosen::findOne(['level' => Dosen::PIMPINAN]))
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
        if ($user = Dosen::findOne(['level' => Dosen::ADMINISTRATOR]))
        {
            return true;
        }
        else
        {
            return false;
        }

    }
}
