<?php
/**
 * Created by PhpStorm.
 * User: kpudaruth
 * Date: 26/10/2015
 * Time: 16:14
 */

namespace App\Services;

use Queue;
use Mail as LaravelMail;
use Config;

/**
 * Class Mail
 * @package App\Services
 */
class Mail
{
    protected $layoutView = 'mail.layout';
    protected $mainView;
    protected $delay = 30; //seconds
    protected $from = "no-reply@el.brightstar.mu";
    protected $from_name = "BrightStar E-Learning";
    protected $to;
    protected $subject;
    protected $enableSettingsFooter = true;

    /**
     * Construct
     */
    public function __construct()
    {

    }

    /**
     * Adds additional meta data
     *
     * @param $data
     */
    private function addMetaData(&$data)
    {
        $data['mainView'] = $this->mainView;
        $data['pageTitle'] = Config::get('website.name')." - ".$this->subject;
        $data['enableSettingsFooter'] = $this->enableSettingsFooter;
    }

    /**
     * Send mail now, through a queue
     *
     * @param array $data
     * @return bool
     */
    public function sendNow(array $data)
    {
        $this->addMetaData($data);

        LaravelMail::queue($this->layoutView, $data, function($message){
            $message->from($this->from,$this->from_name);
            $message->to($this->to);
            $message->subject($this->subject);
        });

        return true;
    }

    /**
     * Send mail later, with delay
     *
     * @param array $data
     * @return bool
     */
    public function sendLater(array $data)
    {
        $this->addMetaData($data);

        LaravelMail::later($this->delay, $this->layoutView, $data, function($message){
            $message->from($this->from,$this->from_name);
            $message->to($this->to);
            $message->subject($this->subject);
        });

        return true;
    }

    /*
     * Setter: delay
     *
     * @param integer $seconds
     * @return App\Services\Mail
     * @throw RuntimeException
     */
    public function setDelay($seconds)
    {
        if(!is_numeric($seconds))
        {
            throw new \RuntimeException("Argument should be numeric.");
        }

        $this->delay = $seconds;
        return $this;
    }

    /*
     * Setter: Main View
     * @param string $mainView
     * @return App\Services\Mail
     */
    public function setMainView($mainView)
    {
        $this->mainView = $mainView;
        return $this;
    }

    /*
     * Setter: Layout View
     *
     * @param string $layoutView
     * @return App\Services\Mail
     */
    public function setLayoutView($layoutView)
    {
        $this->layoutView = $layoutView;
        return $this;
    }

    /*
     * Setter: To (Mail)
     *
     * @param string $email
     * @return App\Services\Mail
     * @throw RuntimeException
     */
    public function to($email)
    {
        if(filter_var($email,FILTER_VALIDATE_EMAIL) === false)
        {
            throw new \RuntimeException("Argument should be an email.");
        }

        $this->to = $email;
        return $this;
    }

    /*
     * Setter: From (Mail)
     *
     * @param string $email
     * @return App\Services\Mail
     * @throw RuntimeException
     */
    public function from($email)
    {
        if(filter_var($email,FILTER_VALIDATE_EMAIL) === false)
        {
            throw new \RuntimeException("Argument should be an email.");
        }

        $this->from = $email;
        return $this;
    }

    /*
     * Setter: Subject
     *
     * @param string $subject
     * @return App\Services\Mail
     */
    public function subject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /*
     * Setter: Settings Footer
     *
     * @param bool $status
     * @return App\Services\Mail
     */
    public function enableSettingsFooter($status)
    {
        if(!is_bool($status))
        {
            throw new \RuntimeException("Argument should be boolean.");
        }

        $this->enableSettingsFooter = $status;
        return $this;
    }
}