<?php

namespace backend\modules\store\forms;

use yii\data\ActiveDataProvider;
use common\models\Store;

class StoreSearch extends Store {

    public $pagesize = 10;
    public $keyword;
    public $status;
    public $type;
    public $is_top;
    public $is_recommend;
    public $is_open;
    public $is_delete;
    public $province_id;

    public function rules() {
        return [
            ['pagesize', 'default', 'value' => 10],
            ['keyword', 'filter', 'filter' => 'trim'],
            [['pagesize', 'status', 'type', 'is_top', 'is_recommend', 'is_open', 'is_delete', 'province_id'], 'integer'],
        ];
    }

    public function search($params) {
        $query = Store::find()->with(['province', 'city', 'area']);

        $provider_params = [
            'query' => $query,
            'sort' => ['defaultOrder' => ['c_id' => SORT_DESC]],
            'pagination' => ['pageSize' => $this->pagesize],
        ];

        if ($this->load($params) && $this->validate()) {
            if ($this->keyword) {
                $query->andWhere([
                    'or',
                    ['like', 'c_title', $this->keyword],
                    ['like', 'c_brand', $this->keyword],
                    ['like', 'c_email', $this->keyword],
                    ['like', 'c_qq', $this->keyword],
                    ['like', 'c_phone', $this->keyword],
                    ['like', 'c_address', $this->keyword],
                    ['like', 'c_mobile', $this->keyword],
                ]);
            }

            if ($this->status) {
                $query->andWhere(['c_status' => $this->status]);
            }

            if ($this->type) {
                $query->andWhere(['c_type' => $this->type]);
            }

            if ($this->is_top) {
                $query->andWhere(['c_is_top' => $this->is_top]);
            }

            if ($this->is_recommend) {
                $query->andWhere(['c_is_recommend' => $this->is_recommend]);
            }

            if ($this->is_open) {
                $query->andWhere(['c_is_open' => $this->is_open]);
            }

            if ($this->is_delete) {
                $query->andWhere(['c_is_delete' => $this->is_delete]);
            }

            if ($this->province_id) {
                $query->andWhere(['c_province_id' => $this->province_id]);
            }

            $provider_params['pagination']['pageSize'] = $this->pagesize;
            $provider_params['query'] = $query;
        }

        return new ActiveDataProvider($provider_params);
    }

}
