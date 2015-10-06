<?php

namespace common\component\oci;
use yii\base\Component;
use yajra\Pdo\Oci8;
use Yii;

class OciDbConnection extends Component
{
    public $dsn;
    public $username;
    public $password;

    public $ociClass = null;

	public function init()
    {
        try {
            $this->ociClass = new Oci8($this->dsn, $this->username, $this->password);
        } catch (ociException $e) {
            throw new \Exception($e);
        }
    }

    public function __call($methodName, $methodParams) {
        if ( method_exists($this->ociClass, $methodName ) ) {
            return call_user_func_array(array($this->ociClass, $methodName), $methodParams);
        }
    }
}

class ociException extends \Exception {}

?>