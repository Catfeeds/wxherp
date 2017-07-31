<?php

namespace backend\forms;

use yii\data\ActiveDataProvider;
use common\models\Admin;

class AdminSearch extends Admin {

    public $pagesize = 10;
    public $keyword;
    public $status;
    public $role_id;

    public function rules() {
        return [
            ['keyword', 'filter', 'filter' => 'trim'],
            [['pagesize', 'status', 'role_id'], 'integer'],
        ];
    }

    public function search($params) {
        $query = Admin::find()->with('adminRole');

        $provider_params = [
            'query' => $query,
            'sort' => ['defaultOrder' => ['c_id' => SORT_DESC]],
            'pagination' => ['pageSize' => $this->pagesize],
        ];

        if ($this->load($params) && $this->validate()) {

            if ($this->keyword) {
                $query->andWhere([
                    'or',
                    ['like', 'c_admin_name', $this->keyword],
                    ['like', 'c_mobile', $this->keyword],
                    ['like', 'c_email', $this->keyword]
                ]);
            }

            if ($this->role_id) {
                $query->andWhere(['c_role_id' => $this->role_id]);
            }

            if ($this->status) {
                $query->andWhere(['c_status' => $this->status]);
            }

            $provider_params['pagination']['pageSize'] = $this->pagesize;
            $provider_params['query'] = $query;
        }

        return new ActiveDataProvider($provider_params);
    }

}
