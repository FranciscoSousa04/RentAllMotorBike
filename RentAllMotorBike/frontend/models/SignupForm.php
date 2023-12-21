<?php

namespace frontend\models;

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
    
    //dados pessoais/profile
    public $nome;
    public $apelido;
    public $telemovel;
    public $nif;
    public $cartaConducao;


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

            ['nome', 'required'],
            ['nome', 'string', 'min' => 3, 'max' => 30],

            ['apelido', 'required'],
            ['apelido', 'string', 'min' => 3, 'max' => 30],

            ['telemovel', 'required'],
            ['telemovel', 'integer', 'min' => 900000000, 'max' => 999999999],

            ['nif', 'required'],
            ['nif', 'integer','min' => 000000000, 'max' => 999999999],

            ['cartaConducao', 'required'],
            ['cartaConducao', 'string', 'min' => 11, 'max' => 13],
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
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->save(false);

        //no signUp é atribuido o role de cliente
        $auth = Yii::$app->authManager;
        $cliente = $auth->getRole('cliente');
        $auth->assign($cliente, $user->getId());
        $user->save();

        $profile = new Profile();
        $profile->id_profile = $user->id;
        $profile->nome = $this->nome;
        $profile->apelido = $this->apelido;
        $profile->nif = $this->nif;
        $profile->telemovel = $this->telemovel;
        $profile->nr_cartaconducao = $this->cartaConducao;
        $profile->save();

        return true;
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
