<?php

namespace backend\forms;

use yii\data\ActiveDataProvider;
use common\models\CollectionDoc;

class CollectionDocSearch extends CollectionDoc {

    public $pagesize = 10;
    public $keyword;
    public $pay_status;

    public function rules() {
        return [
            ['keyword', 'filter', 'filter' => 'trim'],
            [['pagesize', 'pay_status'], 'integer'],
        ];
    }

    public function search($params) {
        $query = CollectionDoc::find()->with('payment');

        $provider_params = [
            'query' => $query,
            'sort' => ['defaultOrder' => ['c_id' => SORT_DESC]],
            'pagination' => ['pageSize' => $this->pagesize],
        ];

        if ($this->load($params) && $this->validate()) {

            if ($this->keyword) {
                $query->andWhere([
                    'or',
                    ['like', 'c_order_no', $this->keyword],
                    ['like', 'c_admin_name', $this->keyword],
                    ['like', 'c_user_name', $this->keyword],
                    ['like', 'c_note', $this->keyword]
                ]);
            }

            if ($this->pay_status) {
                $query->andWhere(['c_pay_status' => $this->pay_status]);
            }

            $provider_params['pagination']['pageSize'] = $this->pagesize;
            $provider_params['query'] = $query;
        }

        return new ActiveDataProvider($provider_params);
    }

}
