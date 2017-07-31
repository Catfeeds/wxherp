<?php

namespace backend\forms;

use yii\data\ActiveDataProvider;
use common\models\UserAcountLog;

class UserAcountLogSearch extends UserAcountLog {

    public $pagesize = 10;
    public $keyword;
    public $type;

    public function rules() {
        return [
            ['keyword', 'filter', 'filter' => 'trim'],
            
            [['pagesize', 'type'], 'integer'],
        ];
    }

    public function search($params) {
        $query = UserAcountLog::find();

        $provider_params = [
            'query' => $query,
            'sort' => ['defaultOrder' => [ 'c_id' => SORT_DESC]],
            'pagination' => ['pageSize' => $this->pagesize],
        ];

        if ($this->load($params) && $this->validate()) {

            if ($this->keyword) {
                $keyword = $this->keyword;
                $user = function ($query) use($keyword) {
                    $query->andWhere([
                        'or',
                        ['like', 'c_user_name', $keyword],
                        ['like', 'c_mobile', $keyword],
                        ['like', 'c_email', $keyword]
                    ]);
                };
                $query->innerJoinWith(['user' => $user]);
            }

            if ($this->type) {
                $query->andWhere(['c_type' => $this->type]);
            }

            $provider_params['pagination']['pageSize'] = $this->pagesize;
            $provider_params['query'] = $query;
        }

        return new ActiveDataProvider($provider_params);
    }

}
