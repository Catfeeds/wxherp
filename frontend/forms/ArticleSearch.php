<?php

namespace frontend\forms;

use Yii;
use yii\data\ActiveDataProvider;
use common\models\Article;

class ArticleSearch extends Article {

    public $pagesize = 10;
    public $keyword;
    public $status;
    public $category_id;

    public function rules() {
        return [
            ['pagesize', 'default', 'value' => 10],
            ['keyword', 'filter', 'filter' => 'trim'],
            [['pagesize', 'status', 'category_id'], 'integer'],
        ];
    }

    public function search($params) {
        $query = Article::find()->where(['c_is_delete' => self::DELETE_NO, 'c_user_id' => Yii::$app->user->id])->with(['articleCategory']);
        $provider_params = [
            'query' => $query,
            'sort' => ['defaultOrder' => [ 'c_id' => SORT_DESC]],
            'pagination' => ['pageSize' => $this->pagesize],
        ];

        if ($this->load($params) && $this->validate()) {
            if ($this->keyword) {
                $query->andWhere([
                    'or',
                    ['like', 'c_author', $this->keyword],
                    ['like', 'c_title', $this->keyword]
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
