<?php

namespace App;

use yii\base\BaseObject;

class Request extends BaseObject
{
    const METHOD_GET     = 1;
    const METHOD_POST    = 2;

    /** @var \yii\console\Request|\yii\web\Request */
    private $request;

    /**
     * @param \yii\console\Request|\yii\web\Request $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    public function getReferrer()
    {
        if (!$this->request->getIsConsoleRequest()){
            return $this->request->getReferrer();
        }
        return '';
    }

    /**
     * @return bool|mixed
     * @throws \Exception
     */
    public function isGet()
    {
        return $this->request->isGet;
    }

    /**
     * @return bool|mixed
     * @throws \Exception
     */
    public function isPost()
    {
        return $this->request->isPost;
    }

    /**
     * @return bool
     */
    public function isAjax()
    {
        return $this->request->isAjax;
    }

    /**
     * @return string
     */
    public function getCsrf()
    {
        return $this->request->getCsrfToken();
    }

    /**
     * @param      $key
     * @param null $default_value
     * @param null $max_value
     * @return int|null
     */
    public function getInt($key, $default_value = null, $max_value = null)
    {
        return $this->getParamInt($key, self::METHOD_GET, $default_value, $max_value);
    }

    /**
     * @param      $key
     * @param null $default_value
     * @return mixed|null
     */
    public function getStr($key, $default_value = null)
    {
        return $this->getParamStr($key, self::METHOD_GET, $default_value);
    }

    /**
     * @param      $key
     * @param null $default_value
     * @return mixed|null
     */
    public function postStr($key, $default_value = null)
    {
        return $this->getParamStr($key, self::METHOD_POST, $default_value);
    }

    /**
     * @param      $key
     * @param null $default_value
     * @param null $max_value
     * @return int|null
     */
    public function postInt($key, $default_value = null, $max_value = null)
    {
        return $this->getParamInt($key, self::METHOD_POST, $default_value, $max_value);
    }

    /**
     * @param string     $key
     * @param int        $source
     * @param mixed|null $default_value
     * @param null|int   $max_value максимальное значение
     * @return int|null
     */
    protected function getParamInt($key, $source = self::METHOD_GET, $default_value = null, $max_value = null)
    {
        $value = $this->getParam($key, $source);
        if (!is_numeric($value)) {
            return $default_value;
        }
        $value_int = (int)$this->getParam($key, $source);

        if (is_numeric($max_value) && $value_int > $max_value) {
            return $max_value;
        }

        return $value_int;
    }

    /**
     * @param string         $key
     * @param array|int|null $source
     * @param mixed|null     $default_value
     * @return mixed|null
     */
    protected function getParamStr($key, $source = self::METHOD_GET, $default_value = null)
    {
        $value = $this->getParam($key, $source);
        if (!is_string($value)) {
            return $default_value;
        }

        return $value;
    }

    /**
     * @param string     $key
     * @param int        $source
     * @param mixed|null $default_value
     * @return mixed|null
     */
    protected function getParam($key, $source = self::METHOD_GET, $default_value = null)
    {
        if ($source == self::METHOD_GET) {
            return $this->get($key, $default_value);
        }

        return $this->post($key, $default_value);
    }

    public function get($key = null, $default_value = null)
    {
        return $this->request->get($key, $default_value);
    }

    public function post($key = null, $default_value = null)
    {
        return $this->request->post($key, $default_value);
    }

    /**
     * @param       $key
     * @param array $default_value
     * @return array|mixed|null
     */
    public function postArrayInt($key, array $default_value = [])
    {
        return $this->getParamArrayInt($key, self::METHOD_POST, $default_value);
    }

    /**
     * @param       $key
     * @param int   $source
     * @param array $default_value
     * @return array
     */
    protected function getParamArrayInt($key, $source = self::METHOD_GET, array $default_value = [])
    {
        $value = $this->getParam($key, $source);
        if (!is_array($value)) {
            return $default_value;
        }
        $items = [];
        foreach ($value as $k => $val) {
            if (is_numeric($val)) {
                $val_int   = (int)$val;
                $items[$k] = $val_int;
            }
        }

        return $items;
    }

    /**
     * @param       $key
     * @param int   $source
     * @param array $default_value
     * @return array
     */
    protected function getParamArrayStr($key, $source = self::METHOD_GET, array $default_value = [])
    {
        $value = $this->getParam($key, $source);
        if (!is_string($value)) {
            return $default_value;
        }

        $items   = [];
        $sale_id = trim($value);

        if (preg_match('/^([^,\s\"\'\\\]+\s*,?\s*)+$/', $sale_id)) {
            $sale_id = preg_split('/[\s,]+/', $sale_id);
        }

        $sale_id = is_array($sale_id) ? $sale_id : [];

        foreach ($sale_id as $k => $val) {
            if (is_string($val)) {
                $val_int   = (string)$val;
                $items[$k] = $val_int;
            }
        }

        return $items;
    }

    /**
     * @param       $key
     * @param array $default_value
     * @return array|mixed|null
     */
    public function postArrayStr($key, array $default_value = [])
    {
        return $this->getParamArrayStr($key, self::METHOD_POST, $default_value);
    }
}
