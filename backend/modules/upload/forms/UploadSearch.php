<?php

namespace backend\modules\upload\forms;

use yii\data\ActiveDataProvider;
use common\models\Upload;

class UploadSearch extends Upload {

    public $pagesize = 10;
    public $keyword;
    public $status;
    public $type;
    public $object_type;
    public $create_type;

    public function rules() {
        return [
            ['keyword', 'filter', 'filter' => 'trim'],
            [['pagesize', 'status', 'type', 'object_type', 'create_type'], 'integer'],
        ];
    }

    public function search($params) {
        $query = Upload::find();

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
                    ['like', 'c_path', $this->keyword]
                ]);
            }

            if ($this->status) {
                $query->andWhere(['c_status' => $this->status]);
            }

            if ($this->type) {
                $query->andWhere(['c_type' => $this->type]);
            }

            if ($this->object_type) {
                $query->andWhere(['c_object_type' => $this->object_type]);
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
