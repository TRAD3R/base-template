<?php
namespace App\SearchList;

use App\AbstractSearchList;
use App\Models\User;
use App\Params;
use yii\db\Query;

class UserSL extends AbstractSearchList
{

    protected function loadResults()
    {
        $this->results = $this->buildQuery()
            ->indexBy('id')
            ->orderBy(['id' => SORT_DESC])
            ->all()
        ;
    }

    protected function loadTotalCount()
    {
        if(!$this->total_count) {
            $this->total_count = $this->buildQuery()
                ->limit(-1)
                ->offset(null)
                ->count()
            ;
        }
        return $this->total_count;
    }

    /**
     * @return Query
     */
    protected function buildQuery()
    {
        $query = new Query();

        $query->from(['u' => User::tableName()])
            ->select('u.*')
            ->where('1 = 1')
            ;

        if(!is_null($this->params[Params::USER_TYPE])) {
            $query->andWhere(['type' => $this->params[Params::USER_TYPE]]);
        }
        if(!is_null($this->params[Params::USER_STATUS])) {
            $query->andWhere(['status' => $this->params[Params::USER_STATUS]]);
        }
        if(!is_null($this->params[Params::USER_CATEGORY])) {
            $query->andWhere(['category' => $this->params[Params::USER_CATEGORY]]);
        }
        if(!empty($this->params[Params::SEARCH])) {
            $query
                ->andWhere([
                    'OR',
                    ['id' => $this->params[Params::SEARCH]],
                    ['LIKE', 'u.username', $this->params[Params::SEARCH]],
                    ['LIKE', 'u.firstname', $this->params[Params::SEARCH]],
                    ['LIKE', 'u.secondname', $this->params[Params::SEARCH]],
                    ['LIKE', 'u.lastname', $this->params[Params::SEARCH]],
                    ['LIKE', 'u.email', $this->params[Params::SEARCH]],
                ])
                ;
        }

        $query
            ->limit($this->params[Params::LIMIT])
            ->offset($this->params[Params::OFFSET])
        ;

        return $query;
    }
}