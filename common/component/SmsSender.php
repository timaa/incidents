<?php
/**
 * Created by PhpStorm.
 * User: taipov
 * Date: 02.10.2015
 * Time: 10:50
 */
namespace common\component;

use yii\base\Object;

class SmsSender extends Object
{
    private $receiversArray;
    private $messagetext;
    private $lang_id = 8;
    private $config = [
        'dsn' => 'mysql:host=10.160.11.173;dbname=sms',
        'username' => 'sms',
        'password' => 'sms2mysql',
    ];

    public function __construct(array $receiversArray, $text, $config = null)
    {
        $this->receiversArray = $receiversArray;
        $this->messagetext = $text;
        if ($config != null )
            if (is_array($config)) {
                $this->config = $config;
            } else {throw new \InvalidArgumentException('$config must be an array');}

        return parent::__construct();
    }

    public function send()
    {
        $db = new \yii\db\Connection($this->config);
        foreach ($this->receiversArray as $receiver) {
            $db->createCommand()->insert("info_msgs",[
                "daddr"  => $receiver['mobile'],
                "text"   => $this->messagetext,
                "lang"   => $this->lang_id,
            ])->execute();
        }
    }

}