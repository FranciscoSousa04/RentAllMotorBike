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
    public $nr_cartaconducao;

    public $id_user;


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

            ['nr_cartaconducao', 'required'],
            ['nr_cartaconducao', 'string', 'min' => 11, 'max' => 13],

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
        $profile->nome = $this->nome;
        $profile->apelido = $this->apelido;
        $profile->nif = $this->nif;
        $profile->telemovel = $this->telemovel;
        $profile->nr_cartaconducao = $this->nr_cartaconducao;
        $profile->id_user = $user->id;
        $profile->save(false);

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
