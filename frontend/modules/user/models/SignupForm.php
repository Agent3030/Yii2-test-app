<?php
namespace frontend\modules\user\models;




use common\models\User;
use yii\base\Exception;
use yii\base\Model;
use Yii;


/**
 * Signup form
 */
class SignupForm extends Model
{
    /**
     * @var
     */
    public $username;
    /**
     * @var
     */
    public $email;
    /**
     * @var
     */

    public $password;

  //  public $password_confirm;

    /**
     * @var
     */

    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique',
                'targetClass'=>'\common\models\User',
                'message' =>'This username has already been taken.'
            ],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass'=> '\common\models\User',
                'message' => 'This email address has already been taken.'
            ],
            ['password', 'required'],
            ['password', 'string', 'min' => 8],

        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'username'=>'Username',
            'email'=>'Email',
            'password'=> 'Password',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {

            $user = new User();

            $user->username = $this->username;
            $user->email = $this->email;
            $user->status = User::STATUS_ACTIVE;
            $user->setPassword($this->password);

            if(!$user->save()) {
                throw new Exception("User couldn't be  saved");
            };
                $user->afterSignup();

            return $user;

        }

        return null;
    }

    /**
     * @return bool
     */
}
