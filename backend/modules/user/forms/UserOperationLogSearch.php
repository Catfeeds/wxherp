<?php

namespace backend\modules\user\forms;

use yii\data\ActiveDataProvider;
use common\models\UserOperationLog;

class UserOperationLogSearch extends UserOperationLog {

    public $pagesize = 10;
    public $keyword;
    public $status;
    public $type;
    public $create_type;

    public function rules() {
        return [
            ['pagesize', 'default', 'value' => 10],
            ['keyword', 'filter', 'filter' => 'trim'],
            [['pagesize', 'status', 'type', 'create_type'], 'integer'],
        ];
    }

    public function search($params) {
        $query = UserOperationLog::find();

        $provider_params = [
            'query' => $query,
            'sort' => ['defaultOrder' => ['c_id' => SORT_DESC]],
            'pagination' => ['pageSize' => $this->pagesize],
        ];

        if ($this->load($params) && $this->validate()) {

            if ($this->keyword) {
                $query->andWhere([
                    'or',
                    ['like', 'c_user_name', $this->keyword],
                    ['like', 'c_route', $this->keyword]
                ]);
            }

            if ($this->status) {
                $query->andWhere(['c_status' => $this->status]);
            }

            if ($this->type) {
                $query->andWhere(['c_type' => $this->type]);
            }

            if ($this->create_type) {
                $query->andWhere(['c_create_type' => $this->create_type]);
            }

            $provider_params['pagination']['pageSize'] = $this->pagesize;
            $provider_params['query'] = $query;
        }

        return new ActiveDataProvider($provider_params);
    }

}
