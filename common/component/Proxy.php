<?php
/**
 * Created by PhpStorm.
 * User: ailyasov
 * Date: 15.05.15
 * Time: 9:25
 */

namespace common\component;

use yii\base\Component;


class Proxy  extends Component
{

    public static function getProxy($url, $proxy) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.0.1) Gecko/2008070208');
        curl_setopt($ch, CURLOPT_PROXY, "$proxy");
        $ss=curl_exec($ch);
        curl_close($ch);
        return $ss;
    }

} 