<?php

namespace backend\modules\article\forms;

use yii\data\ActiveDataProvider;
use common\models\Article;

class ArticleSearch extends Article {

    public $pagesize = 10;
    public $keyword;
    public $status;
    public $category_id;

    public function rules() {
        return [
            ['keyword', 'filter', 'filter' => 'trim'],
            [['pagesize', 'status', 'category_id'], 'integer'],
        ];
    }

    public function search($params) {
        $query = Article::find()->with(['articleCategory']);

        $provider_params = [
            'query' => $query,
            'sort' => ['defaultOrder' => ['c_sort' => SORT_DESC, 'c_id' => SORT_DESC]],
            'pagination' => ['pageSize' => $this->pagesize],
        ];

        if ($this->load($params) && $this->validate()) {
            if ($this->keyword) {
                $query->andWhere([
                    'or',
                    ['like', 'c_title', $this->keyword],
                    ['like', 'c_author', $this->keyword],
                ]);
            }

            if ($this->status) {
                $query->andWhere(['c_status' => $this->status]);
            }

            if ($this->category_id) {
                $query->andWhere(['c_category_id' => $this->category_id]);
            }

            $provider_params['pagination']['pageSize'] = $this->pagesize;
            $provider_params['query'] = $query;
        }

        return new ActiveDataProvider($provider_params);
    }

}
