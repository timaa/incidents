<?php
/**
 * Created by PhpStorm.
 * User: ailyasov
 * Date: 29.04.15
 * Time: 14:22
 */

namespace common\component;
use yii\base\Component;
use yii\helpers\Url;
use Yii;

class adTree extends Component{

    private static $dn;
    public static $homeDirectories = [
        'Блок по продажам и обслуживанию',
        'Группа внутреннего контроля и аудита',
        'Группа по связям с общественностью',
        'Департамент безопасности',
        'Департамент маркетинга и развития операторского бизнеса',
        'Департамент управления закупками и логистикой',
        'Отдел по работе с персоналом',
        'Руководство',
        'Технический блок',
        'Финансовый департамент',
        'Центр обслуживания г. Ташкент',
        'Центры обслуживания в городах',
        'Юридический отдел',
        'Административный департамент'
    ];

    /**
     * Метод преобращующий одномерный массив дерикторий AD в многомерный древовидный,
     * где каждый последующий элемент вклыдвается в родительский
     * @param array $keys
     * @return array
     */
    private static function arrayToTree(array $keys) {
        $result = array();
        $current = &$result;
        while ($keys) {
            $key = array_shift($keys);
            $current[$key] = [];

            $current = &$current[$key];
        }

        return $result;
    }

    /**
     * Вывод подпапок всех не пустых категорий AD
     * @param $directory
     * @return mixed
     */
    public static function checkEmptyDirectory($directory)
    {
        foreach ($directory as $directoryItem)
        {
            $ldap = Yii::$app->ldap->folder()->listing([$directoryItem, 'UMS'], \adLDAP\adLDAP::ADLDAP_FOLDER, true);
            foreach($ldap as $ldapItem)
            {
                $dn = $ldapItem['dn'];
                if(strpos($dn, 'OU=')===false)
                {
                    self::$dn[]= ['dn'=>'OU=' . $directoryItem . ',OU=UMS,DC=ad,DC=ums,DC=uz' ];
                } else {
                    self::$dn[]= $ldapItem;
                }
            }

        }

        return self::$dn;
    }

    /**
     * Метод преобразующий массив дерикторий AD в древовидную структуру
     * @param $list
     * @return array
     */
    public static function adDirectoryToArray($list)
    {
        $mergeArrays =[];

        foreach($list as $directory)
        {
            $dn = $directory['dn'];
            if(strpos($dn, 'CN=')===false)
            {
                $dn = str_replace('\,', '{common}', $dn);
                $ouArray=[];
                $dnArray = explode(',', $dn);
                $dnArray = array_reverse($dnArray);
                $i=1;
                $prefix ='';

                foreach ($dnArray as $dnValue)
                {
                    $dnValue = str_replace('{common}', ',', $dnValue);
                    if(strpos($dnValue, 'OU=')!==false)
                    {
                        if ($i==3){
                            $prefix = str_replace('OU=', '', $dnValue);
                        }

                        $dnValue = str_replace('OU=', '', $dnValue) . ':' .  $prefix;
                        $ouArray[$dnValue]=$dnValue;
                        $i++;
                    }

                }

                $ouArray = self::arrayToTree($ouArray);
                $mergeArrays = array_merge_recursive($mergeArrays, $ouArray);
            }
        }

        return $mergeArrays;
    }

    /**
     * Метод возвращающий папки из заданной директории AD
     * @param $dn - строка директории
     * @return array
     */
    public static function getAdExecutiveDirectories($dn)
    {
        $result=[];
        $users=[];

        $dnToArray = explode('|', $dn);
        $dnToArray = array_reverse($dnToArray);

        $ldap = Yii::$app->ldap->folder()->listing($dnToArray, \adLDAP\adLDAP::ADLDAP_FOLDER, false);

        foreach($ldap as $directory)
        {
            $links=[];
            $dn = $directory['dn'];

            if(strpos($dn, 'CN=')===false)
            {
                $dn = str_replace('\,', '{common}', $dn);
                $dnArray = explode(',', $dn);
                $folderName = str_replace('OU=', '', $dnArray[0]);

                foreach($dnArray as $href)
                {
                    if (strpos($href, 'OU=')!==false)
                        $links[]=str_replace('OU=', '', str_replace('{common}', ',', $href));
                }

                $folderLink = implode('|', array_reverse($links));

                $result['folders'][]=[
                    'href'=>$folderLink,
                    'title'=>str_replace('{common}', ',', $folderName)
                ];
            }
            if(strpos($dn, 'CN=')!==false)
            {
                $dnArray = explode(',', $dn);
                $UserName = str_replace('CN=', '', $dnArray[0]);
                if (count(explode(' ', $UserName))>2)
                    $users[]=$UserName;
            }
        }

        $result['users'] = $users;

        return $result;
    }

    /**
     * Генерация массива для хлебных крошек
     * @param $dn - строка dn из браузера
     * @return array
     */
    public static function getBreadCrumbsLinks($dn)
    {
        $breadCrumbs=[];

        $breadCrumbItems = array_reverse(explode('|',$dn));

        foreach($breadCrumbItems as $item)
        {
            if ($item<>'')
            {
                $breadCrumbLink = explode($item, $dn);
                $breadCrumbs[]=[
                    'url'=>Url::toRoute(['/handbook/index', 'dn' => $breadCrumbLink[0] . $item]) ,
                    'label'=>$item
                ];
            }

        }

        return array_reverse($breadCrumbs);
    }

    public static function getBreadCrumbsLinksFromDn($dn)
    {
        $dn = str_replace('\,', '{common}', $dn);

        $breadCrumbs=[];
        $dnToArray = explode(',', $dn);
        $dnToArray = array_reverse($dnToArray);
        foreach($dnToArray as $folder)
        {
            if(strpos($folder, 'OU=')!==false)
            {
                $breadCrumbs[] = str_replace('OU=', '', str_replace('{common}', ',', $folder));
            }
        }

        return self::getBreadCrumbsLinks(implode('|', $breadCrumbs));
    }

}