<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\Profile;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $role;
    public $nome;
    public $apelido;
    public $telemovel;
    public $nif;
    public $nr_cartaconducao;
    public $id_user;
    public $id_profile;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],

            ['role', 'string'],

            [['nome', 'apelido', 'telemovel', 'nif', 'nr_cartaconducao', 'id_user'], 'required'],
            [['telemovel', 'nif', 'id_user'], 'integer'],
            [['nome', 'apelido', 'nr_cartaconducao'], 'string', 'max' => 20],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $profile = new Profile();

        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->save(false);

        $profile->nome = $this->nome;
        $profile->apelido = $this->apelido;
        $profile->nif = $this->nif;
        $profile->telemovel = $this->telemovel;
        $profile->nr_cartaconducao = $this->nr_cartaconducao;
        $profile->id_user = $user->id;
        $profile->save(false);

        //role atribuido pelo admin ao criar um user/funcionario
        $auth = Yii::$app->authManager;
        $role = $auth->getRole($this->role);
        $auth->assign($role, $user->getId());

        return $user->save();
    }

    public function loadingInfoUser($id)
    {

        $user = User::findOne(['id' => $id]);
        $profile = Profile::findOne(['id_user' => $id]);

        $model = $this;
        $this->id_profile = $profile->id_profile;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->password = $user->password_hash;
        $this->role = $user->role;
        $this->nome = $profile->nome;
        $this->apelido = $profile->apelido;
        $this->nif = $profile->nif;
        $this->telemovel = $profile->telemovel;
        $this->nr_cartaconducao = $profile->nr_cartaconducao;
        $this->id_user = $profile->id_user;

        return $model;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
