<?php

namespace backend\forms;

use yii\data\ActiveDataProvider;
use common\models\DeliveryDoc;

class DeliveryDocSearch extends DeliveryDoc {

    public $pagesize = 10;
    public $keyword;
    public $freight_id;
    public $delivery_id;

    public function rules() {
        return [
            ['keyword', 'filter', 'filter' => 'trim'],
            [['pagesize', 'freight_id', 'delivery_id'], 'integer'],
        ];
    }

    public function search($params) {
        $query = DeliveryDoc::find()->with(['freightCompany', 'delivery']);

        $provider_params = [
            'query' => $query,
            'sort' => ['defaultOrder' => ['c_id' => SORT_DESC]],
            'pagination' => ['pageSize' => $this->pagesize],
        ];

        if ($this->load($params) && $this->validate()) {

            if ($this->keyword) {
                $query->andWhere([
                    'or',
                    ['like', 'c_mobile', $this->keyword],
                    ['like', 'c_phone', $this->keyword],
                    ['like', 'c_full_name', $this->keyword],
                    ['like', 'c_address', $this->keyword],
                    ['like', 'c_delivery_code', $this->keyword],
                    ['like', 'c_note', $this->keyword]
                ]);
            }

            if ($this->freight_id) {
                $query->andWhere(['c_freight_id' => $this->freight_id]);
            }

            if ($this->delivery_id) {
                $query->andWhere(['c_delivery_id' => $this->delivery_id]);
            }

            $provider_params['pagination']['pageSize'] = $this->pagesize;
            $provider_params['query'] = $query;
        }

        return new ActiveDataProvider($provider_params);
    }

}
