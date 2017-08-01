<?php

namespace common\forms;

use Yii;
use yii\base\Model;
use common\messages\Common;
use common\extensions\Util;
use common\extensions\CheckRule;
use common\models\User;
use common\models\UserLoginLog;

class UserLogin extends Model {

    public $username;
    public $password;
    public $remember_me = false;
    public $create_type = User::CREATE_PC;
    private $_user;

    public function rules() {
        return [
            [['username', 'password'], 'trim'],
            [['username', 'password', 'create_type'], 'required'],
            ['remember_me', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels() {
        return [
            'username' => '账号',
            'password' => '密码',
            'remember_me' => '自动登录',
        ];
    }

    public function validatePassword($attribute) {
        if (!$this->hasErrors()) {

            $data['c_status'] = User::STATUS_NO;
            $data['c_create_type'] = $this->create_type;
            $data['c_login_name'] = $this->username;
            $data['c_login_password'] = $this->password;

            $model = $this->getUser();
            if ($model) {
                if ($model->c_status == User::STATUS_NO) {
                    $this->addError($attribute, Yii::t('common', Common::ACCOUNTS_STATUS_ERROR));
                }
                //管理员登录判断
                if ($this->create_type == User::CREATE_ADMIN) {
                    if (empty($model->c_system_group_id) && !CheckRule::checkSuperUser($model->c_id)) {
                        $this->addError($attribute, Yii::t('common', Common::ACCOUNTS_SYSTEM_ERROR));
                    }
                }
                if ($model->c_login_password == User::generatePassword($this->password, $model->c_login_random)) {
                    $data['c_status'] = User::STATUS_YES;
                    $data['c_login_password'] = '';
                } else {
                    $this->lockUser(); //判断是否锁定用户登录状态
                    $this->addError($attribute, Yii::t('common', Common::ACCOUNTS_PASSWORD_ERROR));
                }
            } else {
                $this->addError($attribute, Yii::t('common', Common::ACCOUNTS_PASSWORD_ERROR));
            }
            UserLoginLog::add($data);
        }
    }

    public function login() {
        if ($this->validate()) {
            $this->updateLogin();
            return Yii::$app->user->login($this->_user, $this->remember_me ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    private function updateLogin() {
        $this->_user->c_last_login_time = time();
        $this->_user->c_last_ip = ip2long(Yii::$app->getRequest()->getUserIP());
        $this->_user->c_login_total = $this->_user->c_login_total + 1;
        return $this->_user->save(false); //false 不需要验证提交的数据
    }

    protected function getUser() {
        if ($this->_user === null) {
            if (strstr($this->username, '@') !== false) {
                $this->_user = User::existEmail($this->username);
            } elseif (Util::checkMobile($this->username)) {
                $this->_user = User::existMobile($this->username);
            } else {
                $this->_user = User::existUsername($this->username);
            }
        }

        return $this->_user;
    }

    private function lockUser() {
        $cache_name = 'login_max_count';
        $count = (int) User::getCache($cache_name);
        if ($count >= Yii::$app->params[$cache_name]) {
            $model = $this->getUser();
            $model->c_status = User::STATUS_NO;
            if ($model->save(false)) {
                User::setCache($cache_name, 0);
            }
        } else {
            User::setCache($cache_name, $count + 1);
        }
    }

}
