<?php

namespace frontend\controllers;

use Yii;

class TestController extends \yii\web\Controller {

    public function actionUser() {
        set_time_limit(0);
        //$this->updateUser();
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
                'c_province_id' => $user['province'],
                'c_city_id' => $user['city'],
                'c_area_id' => $user['area'],
                'c_create_time' => $user['ctime'],
            ])->execute();
            Yii::$app->db->createCommand()->insert('t_user_acount', [
                'c_user_id' => $user['uid'],
                'c_create_time' => $user['ctime'],
            ])->execute();
        }
    }

}
