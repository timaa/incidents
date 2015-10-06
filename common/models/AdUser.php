<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

class AdUser implements IdentityInterface
{
    public $id;
    public $username;
    public $email;
    public $phone;
    public $fullname;
    public $authKey;
    public $tabelNumber;
    public $permission;
    public $title;
    public $block;
    public $mobile;

    public static function findIdentity($id)
    {
        $user = \Yii::$app->ldap->user()->find(false, 'personid', $id);
        $userData = \Yii::$app->ldap->user()->info($user[0]);

        $user = new AdUser();
        $user =$user->getUserModelFromData($userData, $user);

        return $user;
    }

    public static function getUserFromFullName($name)
    {
        $result=[];
        $user = \Yii::$app->ldap->user()->find(false, 'displayname', $name);
        $userData = \Yii::$app->ldap->user()->info($user[0]);

        $result['id']=isset($userData[0]['personid'][0])  ? $userData[0]['personid'][0] : '';
        $result['tabelNumber']=isset($userData[0]['employeeid'][0])  ? $userData[0]['employeeid'][0] : '';
        $result['username']=isset($userData[0]['samaccountname'][0])  ? $userData[0]['samaccountname'][0] : '';
        $result['title']=isset($userData[0]['title'][0])  ? $userData[0]['title'][0] : '';
        $result['fullName']=isset($userData[0]['displayname'][0])  ? $userData[0]['displayname'][0] : '';
        $result['email']=isset($userData[0]['mail'][0])  ? $userData[0]['mail'][0] : '';
        $result['phone']=isset($userData[0]['telephonenumber'][0])  ? $userData[0]['telephonenumber'][0] : '';
        $result['mobile']=isset($userData[0]['mobile'][0])  ? $userData[0]['mobile'][0] : '';
        $result['block']=isset($userData[0]['dn'])  ? $userData[0]['dn'] : '';
        $result['ciscoACLin']=isset($userData[0]['ciscoaclin'][0])  ? $userData[0]['ciscoaclin'][0] : '';

        return $result;
    }

    public static function getUserFromName($name)
    {
        $result=[];
        $userData = \Yii::$app->ldap->user()->info($name);

        $result['id']=isset($userData[0]['personid'][0])  ? $userData[0]['personid'][0] : '';
        $result['tabelNumber']=isset($userData[0]['employeeid'][0])  ? $userData[0]['employeeid'][0] : '';
        $result['username']=isset($userData[0]['samaccountname'][0])  ? $userData[0]['samaccountname'][0] : '';
        $result['title']=isset($userData[0]['title'][0])  ? $userData[0]['title'][0] : '';
        $result['fullName']=isset($userData[0]['displayname'][0])  ? $userData[0]['displayname'][0] : '';
        $result['email']=isset($userData[0]['mail'][0])  ? $userData[0]['mail'][0] : '';
        $result['phone']=isset($userData[0]['telephonenumber'][0])  ? $userData[0]['telephonenumber'][0] : '';
        $result['mobile']=isset($userData[0]['mobile'][0])  ? $userData[0]['mobile'][0] : '';
        $result['block']=isset($userData[0]['dn'])  ? $userData[0]['dn'] : '';
        $result['ciscoACLin']=isset($userData[0]['ciscoaclin'][0])  ? $userData[0]['ciscoaclin'][0] : '';

        return $result;
    }

    public function getUserModelFromData($userData, $model)
    {
        $model->id = isset($userData[0]['personid'][0])  ? $userData[0]['personid'][0] : '';
        $model->username = isset($userData[0]['samaccountname'][0])  ? $userData[0]['samaccountname'][0] : '';
        $model->email = isset($userData[0]['mail'][0])  ? $userData[0]['mail'][0] : '';
        $model->title = isset($userData[0]['title'][0])  ? $userData[0]['title'][0] : '';
        $model->phone = isset($userData[0]['telephonenumber'][0])  ? $userData[0]['telephonenumber'][0] : '';
        $model->fullname = isset($userData[0]['displayname'][0])  ? $userData[0]['displayname'][0] : '';
        $model->tabelNumber = isset($userData[0]['employeeid'][0])  ? $userData[0]['employeeid'][0] : '';
        $model->permission = $this->getPermission($userData[0]['dn']);
        $model->block=isset($userData[0]['dn'])  ? $userData[0]['dn'] : '';
        $model->mobile=isset($userData[0]['mobile'][0])  ? $userData[0]['mobile'][0] : '';

        return $model;
    }

    public static function getUserBlockLink($dn)
    {
        $dn = str_replace('\,', '{common}', $dn);

        $ou=[];
        $dnToArray = explode(',', $dn);
        $dnToArray = array_reverse($dnToArray);
        foreach($dnToArray as $folder)
        {
            if(strpos($folder, 'OU=')!==false)
            {
                $ou[] = str_replace('OU=', '', str_replace('{common}', ',', $folder));
            }
        }

        return implode('|', $ou);
    }

    public function getPermission($dn)
    {
        $dn = str_replace('\,', '{common}', $dn);

        $ou=[];
        $dnToArray = explode(',', $dn);
        $dnToArray = array_reverse($dnToArray);
        foreach($dnToArray as $folder)
        {
            if(strpos($folder, 'OU=')!==false)
            {
                $ou[] = str_replace('OU=', '', str_replace('{common}', ',', $folder));
            }
        }

        if (count($ou)>=3)
        {
            $prefix=$ou[2];
        } else {
            $prefix='';
        }

        return array_pop($ou) . ':' . $prefix;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
}