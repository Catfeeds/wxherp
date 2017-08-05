<?php

namespace frontend\controllers;

use Yii;

class TestController extends \yii\web\Controller {

    public function actionUser() {
        set_time_limit(0);
        //$this->updateUser();
        echo 'ok';
    }

    public function actionCanting() {
        set_time_limit(0);
        //$this->updateCanting();
        echo 'ok';
    }

    public function actionBiz() {
        set_time_limit(0);
        $this->updateBiz();
        echo 'ok';
    }

    private function updateUser() {
        $data = Yii::$app->db2->createCommand('SELECT * FROM ts_user')->queryAll();
        foreach ($data as $user) {
            Yii::$app->db->createCommand()->insert('t_user', [
                'c_id' => $user['uid'],
                'c_create_type' => 1,
                'c_login_password' => $user['password'],
                'c_login_random' => $user['login_salt'],
                'c_user_name' => $user['uname'],
                'c_email' => $user['email'] ? $user['email'] : '',
                'c_email_verify' => $user['is_active'] == 1 ? 1 : 2,
                'c_reg_date' => strtotime(date('Y-m-d', $user['ctime'])),
                'c_create_time' => $user['ctime'],
                'c_reg_ip' => ip2long($user['reg_ip']),
                'c_last_ip' => ip2long($user['reg_ip']),
                'c_status' => $user['is_del'] == 1 ? 2 : 1,
                'c_last_login_time' => $user['last_login_time'] ? $user['last_login_time'] : $user['ctime'],
            ])->execute();
            Yii::$app->db->createCommand()->insert('t_user_profile', [
                'c_user_id' => $user['uid'],
                'c_nick_name' => $user['uname'],
                'c_sex' => $user['sex'],
                'c_sign' => $user['intro'] ? $user['intro'] : '',
//                'c_province_id' => $user['province'],
//                'c_city_id' => $user['city'],
//                'c_area_id' => $user['area'],
                'c_create_time' => $user['ctime'],
            ])->execute();
            Yii::$app->db->createCommand()->insert('t_user_acount', [
                'c_user_id' => $user['uid'],
                'c_create_time' => $user['ctime'],
            ])->execute();
        }
    }

    private function updateCanting() {
        $data = Yii::$app->db2->createCommand('SELECT * FROM ts_jj_canting')->queryAll();
        foreach ($data as $user) {
            //0 关闭 1正常 2待审
            $status = 1;
            $is_open = 1;
            if ($user['isshow'] == 1) {
                $status = 1;
            } elseif ($user['isshow'] == 2) {
                $status = 2;
            } elseif ($user['isshow'] == 0) {
                $is_open = 2;
            }
            Yii::$app->db->createCommand()->insert('t_restaurant', [
                'c_id' => $user['bid'],
                'c_brand' => $user['subname'] ? $user['subname'] : '',
                'c_title' => $user['name'],
                'c_seo' => '',
                'c_keyword' => '',
                'c_description' => $user['description'] ? $user['description'] : '',
                'c_worktime' => $user['worktime'] ? $user['worktime'] : '',
                'c_banner' => '',
                'c_picture' => $user['thumb'] ? strtolower($user['thumb']) : '',
                'c_video' => $user['video'] ? $user['video'] : '',
                'c_email' => $user['email'] ? $user['email'] : '',
                'c_qq' => $user['qq'] ? $user['qq'] : '',
                'c_wangwang' => $user['wangwang'] ? $user['wangwang'] : '',
                'c_website' => $user['website'] ? $user['website'] : '',
                'c_phone' => $user['phone'] ? $user['phone'] : '',
                'c_join_phone' => $user['joinphone'] ? $user['joinphone'] : '',
                'c_coordinate' => $user['mappos'] ? $user['mappos'] : '',
                'c_address' => $user['address'] ? $user['address'] : '',
                'c_bus' => $user['bus'] ? $user['bus'] : '',
                'c_subway' => $user['subway'] ? $user['subway'] : '',
                'c_seat' => $user['seat'] ? $user['seat'] : '',
                'c_feature' => $user['otese'] ? $user['otese'] : '',
                'c_cookbook' => $user['caipu'] ? $user['caipu'] : '',
                //'c_dtds_introduce' => $user['inhome'],
                'c_mobile' => $user['mphone'] ? $user['mphone'] : '',
                'c_discount' => $user['discount'],
                'c_type' => $user['category_id'],
                'c_is_delete' => $user['isdel'] ? 1 : 2,
                'c_is_card' => $user['iscard'] ? 1 : 2,
                'c_is_top' => $user['istop'] ? 1 : 2,
                'c_is_recommend' => $user['isrecommend'] ? 1 : 2,
                'c_is_upload' => $user['isalbum'] ? 1 : 2,
                'c_is_comment' => $user['iscomment'] ? 1 : 2,
                'c_is_shop' => 2,
                'c_is_join' => $user['isjoin'] ? 1 : 2,
                'c_is_dtds' => $user['isinhome'] ? 1 : 2,
                'c_is_open' => $is_open,
                'c_status' => $status,
                'c_parent_id' => $user['pbid'],
                'c_favorite_count' => 0,
                'c_comment_count' => 0,
                'c_favor_count' => 0,
                'c_user_id' => $user['uid'],
                'c_create_uid' => $user['cuid'],
                'c_open_time' => $user['opentime'],
                'c_province_id' => $user['province_id'],
                'c_city_id' => $user['city_id'],
                'c_area_id' => $user['area_id'],
                'c_sort' => $user['px'],
                'c_hits' => $user['hit'],
                'c_create_time' => $user['addtime'],
                'c_update_time' => date('Y-m-d H:i:s', $user['updatetime']),
            ])->execute();
            $array = [];
            if ($user['cuisine_id']) {
                $_array = explode(',', $user['cuisine_id']);
                foreach ($_array as $v) {
                    $array[] = [$user['bid'], 2, $v];
                }
            }
            if ($user['food_id']) {
                $_array = explode(',', $user['food_id']);
                foreach ($_array as $v) {
                    $array[] = [$user['bid'], 2, $v];
                }
            }
            if ($user['tag_id']) {
                $_array = explode(',', $user['tag_id']);
                foreach ($_array as $v) {
                    $array[] = [$user['bid'], 2, $v];
                }
            }
            if ($user['fuwu_id']) {
                $_array = explode(',', $user['fuwu_id']);
                foreach ($_array as $v) {
                    $array[] = [$user['bid'], 2, $v];
                }
            }
            if ($user['tese_id']) {
                $_array = explode(',', $user['tese_id']);
                foreach ($_array as $v) {
                    $array[] = [$user['bid'], 2, $v];
                }
            }
            /**
              const LABEL_TYPE = 1; //餐厅类别
              const LABEL_CUISINE = 2; //餐厅风味 cuisine
              const LABEL_FOOD = 3; //食店类型 food
              const LABEL_MATERIAL = 4; //食材保证 tag_id
              const LABEL_SERVICE = 5; //餐厅服务 fuwu_id
              const LABEL_FEATURE = 6; //餐厅特色 tese_id
              const LABEL_ATMOSPHERE = 7; //餐厅氛围 fenwei_id
              const LABEL_RECOMMEND = 8; //餐厅功能 recommend_id
             */
            if ($array) {
                Yii::$app->db->createCommand()->batchInsert('t_restaurant_label', ['c_restaurant_id', 'c_type', 'c_value'], $array)->execute();
            }

            Yii::$app->db->createCommand()->insert('t_restaurant_text', [
                'c_restaurant_id' => $user['bid'],
                'c_content' => $user['content'],
                'c_dtds_introduce' => $user['inhome'],
                'c_create_time' => $user['addtime'],
                'c_update_time' => date('Y-m-d H:i:s', $user['updatetime']),
            ])->execute();
        }
    }

    private function updateBiz() {
        $data = Yii::$app->db2->createCommand('SELECT * FROM ts_jj_biz')->queryAll();
        foreach ($data as $user) {
            //0 关闭 1正常 2待审
            $status = 1;
            $is_open = 1;
            if ($user['isshow'] == 1) {
                $status = 1;
            } elseif ($user['isshow'] == 2) {
                $status = 2;
            } elseif ($user['isshow'] == 0) {
                $is_open = 2;
            }
            Yii::$app->db->createCommand()->insert('t_store', [
                'c_id' => $user['bid'],
                'c_brand' => $user['subname'] ? $user['subname'] : '',
                'c_title' => $user['name'],
                'c_seo' => '',
                'c_keyword' => '',
                'c_description' => $user['description'] ? $user['description'] : '',
                'c_worktime' => '',
                'c_banner' => '',
                'c_picture' => $user['thumb'] ? strtolower($user['thumb']) : '',
                'c_video' => $user['video'] ? $user['video'] : '',
                'c_email' => $user['email'] ? $user['email'] : '',
                'c_qq' => $user['qq'] ? $user['qq'] : '',
                'c_wangwang' => $user['wangwang'] ? $user['wangwang'] : '',
                'c_website' => $user['website'] ? $user['website'] : '',
                'c_phone' => $user['phone'] ? $user['phone'] : '',
                'c_join_phone' => '',
                'c_coordinate' => $user['mappos'] ? $user['mappos'] : '',
                'c_address' => $user['address'] ? $user['address'] : '',
                'c_mobile' => $user['mphone'] ? $user['mphone'] : '',
                'c_discount' => $user['discount'],
                'c_type' => $user['category_id'],
                'c_is_delete' => $user['isdel'] ? 1 : 2,
                'c_is_card' => $user['iscard'] ? 1 : 2,
                'c_is_top' => $user['istop'] ? 1 : 2,
                'c_is_recommend' => $user['isrecommend'] ? 1 : 2,
                'c_is_upload' => 1,
                'c_is_comment' => 1,
                'c_is_shop' => 2,
                'c_is_join' => 2,
                'c_is_open' => $is_open,
                'c_status' => $status,
                'c_parent_id' => $user['pbid'],
                'c_favorite_count' => 0,
                'c_comment_count' => 0,
                'c_favor_count' => 0,
                'c_user_id' => $user['uid'],
                'c_create_uid' => $user['cuid'],
                'c_province_id' => $user['province_id'],
                'c_city_id' => $user['city_id'],
                'c_area_id' => $user['area_id'],
                'c_sort' => $user['px'],
                'c_hits' => $user['hit'],
                'c_create_time' => $user['addtime'],
                'c_update_time' => date('Y-m-d H:i:s', $user['updatetime']),
            ])->execute();


            Yii::$app->db->createCommand()->insert('t_store_text', [
                'c_store_id' => $user['bid'],
                'c_content' => $user['content'],
                'c_create_time' => $user['addtime'],
                'c_update_time' => date('Y-m-d H:i:s', $user['updatetime']),
            ])->execute();
        }
    }

}
