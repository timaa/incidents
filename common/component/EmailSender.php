<?php
/**
 * Created by PhpStorm.
 * User: taipov
 * Date: 02.10.2015
 * Time: 11:16
 */

namespace common\component;

use yii\base\Object;

class EmailSender extends Object
{
    private $receiversArray;
    private $messageText;
    private $title ;
    private $senderEmail = "hotline@myums.uz";

    public function __construct(array $receiversArray, $text, $title)
    {
        $this->receiversArray = $receiversArray;
        $this->messageText = $text;
        $this->title = $title;

        return parent::__construct();
    }


    public function send()
    {
        $message = \Yii::$app->mailer->compose();
        $failures="";
        foreach ($this->receiversArray as $receiver) {
            $message->setTo($receiver["email"])
            ->setFrom([$this->senderEmail => $this->title])
            ->setSubject($this->title)
            ->setTextBody($this->messageText)
            ->send($message->getSwiftMessage(),$failures);
        }

        print_r($failures);
    }

}