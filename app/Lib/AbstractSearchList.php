<?php

namespace App;

use yii\db\Connection;

abstract class AbstractSearchList
{

    /**
     * Параметры поиска
     * @var array
     */
    protected $params;

    /**
     * Результаты поиска
     * @var array
     */
    protected $results;

    /**
     * Общее количество результатов поиска не учитывая лимиты
     * @var int
     */
    protected $total_count;

    /**
     * @var Connection
     */
    protected $db_connection;

    /**
     * Конструктор
     * @param array|null $params
     */
    public function __construct($params = null)
    {
        if ($params !== null) {
            $this->setParams($params);
        }
        $this->init();
    }

    /**
     * Инициализация
     */
    protected function init()
    {

    }

    /**
     * @return Connection
     */
    protected function getDbConnection()
    {
        if ($this->db_connection === null) {
            $this->db_connection = App::i()->getDb();
        }

        return $this->db_connection;
    }

    /**
     * Сеттер соединения с базов (мастер или слейв)
     * @param Connection $db_connection
     * @return $this
     */
    public function setDbConnection(Connection $db_connection)
    {
        $this->db_connection = $db_connection;

        return $this;
    }

    /**
     * Установка параметров поиска
     * @param array $params
     * @param bool  $overwrite
     * @return $this
     */
    public function setParams(array $params, $overwrite = true)
    {
        if ($overwrite) {
            $this->params = $params;
        } else {
            foreach ($params as $key => $value) {
                $this->params[$key] = $value;
            }
        }

        $this->results     = null;
        $this->total_count = null;
        $this->totals      = null;

        return $this;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Процесс поиска и заполнение его результатами аттрибута results
     */
    abstract protected function loadResults();

    /**
     * Процесс выяснения общего количества результатов поиска без учета лимитов и запись числа в аттрибут total_count
     */
    abstract protected function loadTotalCount();

    /**
     * Действия перед выполнением заполнения
     */
    protected function preLoadResults()
    {
    }

    /**
     * Действия после выполнением заполнения
     */
    protected function afterLoadResults()
    {
    }

    /**
     * Вообще здесь можно переопределить $this->result = []
     * таким образом код дальше не будет выполняться
     */
    protected function prepareData()
    {
    }

    /**
     * @return array
     */
    public function getResults()
    {
        $this->prepareData();
        if ($this->results === null) {
            $this->preLoadResults();
            $this->loadResults();
            $this->afterLoadResults();
        }

        return $this->results;
    }

    /**
     * Получение общего количества результатов поиска без учета лимитов
     * @return int
     */
    public function getTotalCount()
    {
        if ($this->total_count === null) {
            $this->loadTotalCount();
        }

        return $this->total_count;
    }
}