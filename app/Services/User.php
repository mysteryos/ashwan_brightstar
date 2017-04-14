<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 15/10/2015
 * Time: 13:36
 */

namespace App\Services;

Use Sentinel;
Use Reminder;
Use Activation;
Use Validator;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Exceptions\HttpExceptionWithError;
use Symfony\Component\HttpFoundation\Response;

class User extends Service
{

    /**
     * Check if user is activated
     *
     * @param \Cartalyst\Sentinel\Users\UserInterface $user
     * @return \Cartalyst\Sentinel\Activations\EloquentActivation | false
     * @throws HttpException
     */
    public function checkActivationUser(\Cartalyst\Sentinel\Users\UserInterface $user)
    {
        $activationCompleted = Activation::completed($user);
        if (!$activationCompleted) {
            throw new HttpException(Response::HTTP_UNAUTHORIZED, 'Your account ' . $user->email . ' has not yet been activated. Please contact HR.');
        }

        return $activationCompleted;
    }

    /**
     * Check if user is valid for login
     *
     * @param string $email
     * @return bool
     * @throws HttpException
     */
    public function checkValidLoginUser($email)
    {
        //Is user registered
        $user = Sentinel::findByCredentials([
            'email' => $email
        ]);

        if (!$user) {
            //User doesn't exist
            throw new HttpException(Response::HTTP_UNAUTHORIZED, 'Your email ' . $email . ' is not registered on the system. Please contact BrightStar.');
        }

        //If system user, block login
        if ($this->isSystemUser($user->id)) {
            throw new HttpException(Response::HTTP_UNAUTHORIZED, 'You cannot login using the system user.');
        }

        //Is user activated
        $this->checkActivationUser($user);

        return true;
    }

    /**
     * Register a user by email
     *
     * @param array $credentials
     * @return \Cartalyst\Sentinel\Users\UserInterface
     * @throws HttpException | HttpExceptionWithError
     */
    public function registerByEmail(array $credentials)
    {
        $this->validate($credentials, $this->repository->user->getRegisterEmailValidationRules());

        $user = Sentinel::register($credentials);
        if ($user !== false) {
            return $user;
        } else {
            throw new HttpException(Response::HTTP_BAD_REQUEST, 'Unable to register your account; Something bad happened.');
        }

    }

    /**
     * Sign in user by email
     *
     * @param array $credentials
     * @return bool
     * @throws HttpExceptionWithError
     */
    public function loginByEmail(array $credentials)
    {
        $this->validate($credentials,$this->repository->user->getLoginEmailValidationRules());

        if ($this->checkValidLoginUser($credentials['email'])) {
            if (Sentinel::authenticate($credentials, isset($credentials['remember_me']))) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    /**
     * Log Out User
     *
     * @param bool | \Cartalyst\Sentinel\Users\UserInterface
     * @return boolean
     */

    public function logout($user = false)
    {
        if ($user === false) {
            //Logout Current user
            Sentinel::logout();
        } else {
            Sentinel::logout($user);
        }

        return true;
    }

    /**
     * Save changes to user
     *
     * @param integer $user_id
     * @param array $data
     * @return bool
     * @throws HttpException | HttpExceptionWithError
     */

    public function save($user_id,array $data)
    {
        if(!is_numeric($user_id)) {
            throw new HttpException(Response::HTTP_BAD_REQUEST,"User id is not valid.");
        }

        $this->validate($data,$this->repository->user->getSaveUserValidationRules($user_id));

        $user = \Sentinel::findById($user_id);

        if($user) {
            //Fill user with data
            if(Sentinel::update($user, $data)) {
                return true;
            }
            else {
                throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR,'Something bad happened! We are on it');
            }
        }
        else {
            throw new HttpException(Response::HTTP_BAD_REQUEST,'User not found.');
        }
    }

    /**
     * User forgot password instructions
     *
     * @param $input
     * @return bool
     * @throws \HttpException
     */
    public function forgotPassword($input)
    {
        $this->validate($input,$this->repository->user->getForgotPasswordValidationRules());

        $user = Sentinel::findByCredentials([
            'email' => $input['email']
        ]);

        if($user) {
            //Clear all expired
            Reminder::removeExpired();

            //Clear existing reminder
            $existingReminder = Reminder::exists($user);
            if($existingReminder !== false) {
                $existingReminder->delete();
            }

            //Create Reminder
            $reminder = Reminder::create($user);
            if($reminder) {
                $this->sendForgotPasswordEmail($user,$reminder);
                return true;
            }
            else {
                throw new \HttpException(Response::HTTP_INTERNAL_SERVER_ERROR,'Something bad happened. We are on it.');
            }

        }
        else {
            throw new HttpException(Response::HTTP_BAD_REQUEST,'Your email is not registered on our system');
        }
    }

    /**
     * Send email to reset password
     *
     * @param \Cartalyst\Sentinel\Users\EloquentUser $user
     * @param \Cartalyst\Sentinel\Reminders\EloquentReminder $reminder
     * @return bool
     */
    private function sendForgotPasswordEmail(\Cartalyst\Sentinel\Users\EloquentUser $user,\Cartalyst\Sentinel\Reminders\EloquentReminder $reminder)
    {
        $data = array();
        $data['name'] = $user->first_name." ".$user->last_name;
        $data['reset_password_link'] = action('UserController@resetPassword',['code'=>$reminder->code,'email'=>$user->email]);

        $mail = app('App\Services\Mail');

        $mail->setMainView('mail.forgot_password')
             ->enableSettingsFooter(false)
             ->to($user->email)
             ->subject("Password Reset");

        $mail->sendNow($data);

    }

    /**
     * Reset user's password through reminder code
     *
     * @param array $input
     * @return bool
     * @throws HttpException
     */
    public function resetPassword(array $input)
    {

        $this->validate($input,$this->repository->user->getResetPasswordValidationRules());

        $user = Sentinel::findByCredentials([
            'email' => $input['email']
        ]);

        if($user) {
            if(Reminder::complete($user, $input['code'], $input['password'])) {
                return true;
            }
            else {
                throw new HttpException(Response::HTTP_BAD_REQUEST,'Unable to reset your password. Please try again by clicking the password reset link in the mail.');
            }
        }
        else {
            throw new HttpException(Response::HTTP_BAD_REQUEST,'Your email is not registered on the system');
        }
    }

    /**
     * Activate User
     *
     * @param int $user_id
     * @return bool
     * @throws HttpException
     */
    public function activate($user_id)
    {
        $user = Sentinel::findById($user_id);

        //Check if user exists
        if($user) {
            $activationCompleted = Activation::completed($user);
            //Not yet activated
            if($activationCompleted === false) {
                //If activation doesn't exist, create one
                $activation = Activation::exists($user);
                if($activation === false) {
                    $activation = Activation::create($user);
                }

                return Activation::complete($user,$activation->code);
            }
            else {
                throw new HttpException(Response::HTTP_BAD_REQUEST,"User id #{$user_id} is already activated on the system");
            }
        } else {
            throw new HttpException(Response::HTTP_BAD_REQUEST,'User id #'.$user_id.' doesn\'t exist on the system');
        }
    }

    /**
     * Send Activation Mail
     *
     * @param \App\Models\User $current_user
     * @param int $user_id
     * @return bool
     */
    public function sendActivationMail(\App\Models\User $current_user,$user_id)
    {
        $concerned_user = Sentinel::findById($user_id);
        if($concerned_user) {
            $data = array();
            $data['concerned_user_name'] = $concerned_user->getName();
            $data['current_user_name'] = $current_user->getName();

            //Send Mail
            $this->service->mail
                ->setMainView('mail.admin.users.activate_user_profile')
                ->enableSettingsFooter(false)
                ->to($concerned_user->email)
                ->subject("Activation Successful")
                ->sendLater($data);

            return true;
        } else {
            \Log::info('User id #'.$user_id.' doesn\'t exist on the system');
            return false;
        }
    }

    /**
     * Deactivate user
     *
     * @param int $user_id
     * @return bool
     * @throws HttpException
     */
    public function deactivate($user_id)
    {
        $user = Sentinel::findById($user_id);

        //Check if user exists
        if($user) {

            //Check if superAdmin
            if($this->service->permission->isSuperAdmin($user)) {
                throw new HttpException(Response::HTTP_BAD_REQUEST,'Deactivating a superadmin is forbidden.');
            }

            return Activation::remove($user);
        }
        else {
            throw new HttpException(Response::HTTP_BAD_REQUEST,'User id doesn\'t exist on the system');
        }
    }

    /**
     * Send Deactivation Mail
     *
     * @param \App\Models\User $current_user
     * @param int $user_id
     * @return bool
     */
    public function sendDeactivationMail(\App\Models\User $current_user,$user_id)
    {
        $concerned_user = Sentinel::findById($user_id);
        if($concerned_user) {
            $data = array();
            $data['concerned_user_name'] = $concerned_user->getName();
            $data['current_user_name'] = $current_user->getName();

            //Send Mail
            $this->service->mail
                ->setMainView('mail.admin.users.deactivate_user_profile')
                ->enableSettingsFooter(false)
                ->to($concerned_user->email)
                ->subject("Deactivation Successful")
                ->sendLater($data);

            return true;
        } else {
            \Log::info('Unable to send mail: User id #'.$user_id.' doesn\'t exist on the system');
            return false;
        }
    }

    /**
     * Check if user is system user
     *
     * @param int $user_id
     * @return bool
     */
    public function isSystemUser($user_id)
    {
        return (int)\Config::get('website.system_user_id') === (int)$user_id;
    }

    /*
     * Avatar: START
     */

    /**
     * Generate Avatar HTML
     *
     * @param \App\Models\User $user
     * @param string $size
     * @param string $additional_classes
     * @return string
     */
    public function getAvatarHTML($user,$size='normal',$additional_classes='')
    {
        switch($size) {
            case 'small':
                $sizeClass = 'avatar-xs';
                break;
            case 'medium':
                $sizeClass = 'avatar-sm';
                break;
            default:
            case 'normal':
                $sizeClass = '';
                break;
        }


        if($user) {
            //Default to name avatar
            $avatarColor = $this->getAvatarColor($user);
            return "<div class='avatar $sizeClass $additional_classes avatar-color-$avatarColor' title='{$user->getName()}'>{$user->first_name[0]} {$user->last_name[0]}</div>";
        } else {
            return "<div class='avatar $sizeClass $additional_classes bgm-gray'>N/A</div>";
        }
    }

    /**
     * Generate User's Avatar Color
     *
     * @param \App\Models\User $user
     * @return int
     */
    public function getAvatarColor($user)
    {
        $avatars = \Cache::get('avatars',array());

        //User doesn't have an avatar
        if(!array_key_exists($user->email,$avatars))
        {
            //Assign Avatar
            $randcolor = rand(1,18);
            if(in_array($randcolor,$avatars))
            {
                //Someone somewhere has our color, A finer drill down by name is required.
                $firstletter = $user->email[0];
                $colorarray = array();
                foreach($avatars as $k=>$v)
                {
                    if($k[0] == $firstletter)
                    {
                        $colorarray[] = $v;
                    }
                }
                if(count($colorarray)<18)
                {
                    //Someone's getting a unique color today :)
                    While(in_array($randcolor,$colorarray))
                    {
                        $randcolor = rand(1,18);
                    }
                }
            }
            //Assign Color
            $avatars[$user->email] = $randcolor;
            \Cache::forever('avatars',$avatars);
        }

        return $avatars[$user->email];

    }

    /*
     * Avatar: END
     */

    public function getSystemUser()
    {
        $systemUserId = \Config::get('website.system_user_id');
        $user = Sentinel::findUserById($systemUserId);

        return $user;
    }

}