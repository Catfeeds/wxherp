<?php

namespace backend\modules\feedback\forms;

use yii\data\ActiveDataProvider;
use common\models\Feedback;

class FeedbackSearch extends Feedback {

    public $pagesize = 10;
    public $keyword;
    public $status;

    public function rules() {
        return [
            ['pagesize', 'default', 'value' => 10],
            ['keyword', 'filter', 'filter' => 'trim'],
            [['pagesize', 'status'], 'integer'],
        ];
    }

    public function search($params) {
        $query = Feedback::find();

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
                    ['like', 'c_full_name', $this->keyword],
                    ['like', 'c_email', $this->keyword],
                    ['like', 'c_phone', $this->keyword],
                    ['like', 'c_title', $this->keyword]
                ]);
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
