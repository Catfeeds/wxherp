<?php

namespace common\models;

use Yii;
use yii\web\IdentityInterface;
use common\extensions\Util;
use common\messages\Common;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property string $c_id
 * @property string $c_login_random
 * @property string $c_pay_random
 * @property string $c_mobile
 * @property string $c_login_password
 * @property string $c_pay_password
 * @property string $c_auth_key
 * @property string $c_access_token
 * @property string $c_user_name
 * @property string $c_email
 * @property integer $c_user_group_id
 * @property integer $c_system_group_id
 * @property integer $c_mobile_verify
 * @property integer $c_email_verify
 * @property integer $c_status
 * @property integer $c_create_type
 * @property string $c_login_total
 * @property string $c_last_login_time
 * @property string $c_reg_date
 * @property integer $c_reg_ip
 * @property integer $c_last_ip
 * @property string $c_create_time
 * @property string $c_update_time
 */
class User extends _CommonModel implements IdentityInterface {

    private $_system_route;
    //登录密码
    public $old_password;
    public $new_password;
    public $new_password_confirm;
    //支付密码
    public $old_pay_password;
    public $new_pay_password;
    public $new_pay_password_confirm;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            /* 默认值 */
            [['c_user_group_id', 'c_system_group_id'], 'default', 'value' => 0],
            /* 过滤空格 */
            [['c_user_name', 'c_mobile', 'c_email', 'old_password', 'new_password', 'old_pay_password', 'new_pay_password'], 'trim'],
            //用户名
            ['c_user_name', 'required', 'on' => ['mobile_register', 'email_register', 'system_register']],
            ['c_user_name', 'string', 'length' => [3, 20], 'tooLong' => '{attribute}长度最多为{max}个字符', 'tooShort' => '{attribute}长度最少为{min}个字符', 'on' => ['mobile_register', 'email_register', 'system_register']],
            ['c_user_name', 'unique', 'message' => '{attribute}已存在', 'on' => ['mobile_register', 'email_register', 'system_register']],
            //手机号
            ['c_mobile', 'match', 'pattern' => '/^1[3578][0-9]{9}$/', 'message' => '{attribute}格式错误', 'on' => ['mobile_register', 'system_register']],
            ['c_mobile', 'unique', 'message' => '{attribute}已存在', 'on' => ['mobile_register', 'system_register']],
            //邮箱
            ['c_email', 'email', 'message' => '{attribute}格式错误', 'on' => ['email_register', 'system_register']],
            ['c_email', 'unique', 'message' => '{attribute}已存在', 'on' => ['email_register', 'system_register']],
            //原登录密码
            ['old_password', 'required', 'on' => ['change-password', 'setting-pay-password', 'validate-password']],
            ['old_password', 'string', 'length' => [6, 20], 'tooLong' => '{attribute}长度最多为{max}个字符', 'tooShort' => '{attribute}长度最少为{min}个字符', 'on' => ['change-password', 'setting-pay-password', 'validate-password']],
            ['old_password', 'validateLoginPassword', 'on' => ['change-password', 'setting-pay-password', 'validate-password']],
            //登录密码
            ['new_password', 'required', 'on' => ['mobile_register', 'email_register', 'system_register', 'setting-password']],
            ['new_password', 'string', 'length' => [6, 20], 'tooLong' => '{attribute}长度最多为{max}个字符', 'tooShort' => '{attribute}长度最少为{min}个字符', 'on' => ['mobile_register', 'email_register', 'system_register', 'setting-password']],
            //确认登录密码
            ['new_password_confirm', 'required', 'on' => ['mobile_register', 'email_register', 'system_register', 'setting-password']],
            ['new_password_confirm', 'compare', 'compareAttribute' => 'new_password', 'message' => '两次设置的登录密码不一致', 'on' => ['mobile_register', 'email_register', 'system_register', 'setting-password']],
            //原支付密码
            ['old_pay_password', 'required', 'on' => ['change-pay-password']],
            ['old_pay_password', 'string', 'length' => [6, 20], 'tooLong' => '{attribute}长度最多为{max}个字符', 'tooShort' => '{attribute}长度最少为{min}个字符', 'on' => ['change-pay-password']],
            ['old_pay_password', 'validatePayPassword', 'on' => ['change-pay-password']],
            //支付密码
            ['new_pay_password', 'required', 'on' => ['setting-pay-password', 'new_pay_password']],
            ['new_pay_password', 'string', 'length' => [6, 20], 'tooLong' => '{attribute}长度最多为{max}个字符', 'tooShort' => '{attribute}长度最少为{min}个字符', 'on' => ['setting-pay-password', 'new_pay_password']],
            //确认支付密码
            ['new_pay_password_confirm', 'required', 'on' => ['setting-pay-password', 'new_pay_password']],
            ['new_pay_password_confirm', 'compare', 'compareAttribute' => 'new_pay_password', 'message' => '两次设置的支付密码不一致', 'on' => ['setting-pay-password', 'new_pay_password']],
            /**/
            [['c_user_group_id', 'c_system_group_id', 'c_mobile_verify', 'c_email_verify', 'c_status', 'c_create_type', 'c_login_total', 'c_last_login_time', 'c_reg_date', 'c_reg_ip', 'c_last_ip', 'c_create_time'], 'integer'],
            [['c_update_time'], 'safe'],
            [['c_login_random', 'c_pay_random'], 'string', 'max' => 4],
            [['c_mobile'], 'string', 'max' => 11],
            [['c_login_password', 'c_pay_password', 'c_auth_key'], 'string', 'max' => 32],
            [['c_access_token'], 'string', 'max' => 43],
            [['c_user_name'], 'string', 'max' => 20],
            [['c_email'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_login_random' => '登录秘密随机字符串',
            'c_pay_random' => '支付秘密随机字符串',
            'c_mobile' => '手机号',
            'c_login_password' => '登录密码',
            'c_pay_password' => '支付密码',
            'c_auth_key' => 'cookie用户认证',
            'c_access_token' => 'api 通过access_token参数登录',
            'c_user_name' => '用户名',
            'c_email' => '邮箱',
            'c_user_group_id' => '用户组',
            'c_system_group_id' => '管理组',
            'c_mobile_verify' => '手机验证', // 1已验证 2未绑定 3待验证
            'c_email_verify' => '邮箱验证', // 1已验证 2未绑定 3待验证
            'c_status' => '用户登录状态', // 1正常 2无效
            'c_create_type' => '来源类型', // 1PC 2H5 3IOS 4Andriod 8其他 9平台
            'c_login_total' => '登录次数',
            'c_last_login_time' => '最后登录时间',
            'c_reg_date' => '注册日期',
            'c_reg_ip' => '注册IP',
            'c_last_ip' => '最后登录IP',
            'c_create_time' => '创建时间',
            'c_update_time' => '最后更新时间',
            'old_password' => '原登录密码',
            'new_password' => '新登录密码',
            'new_password_confirm' => '确认登录密码',
            'old_pay_password' => '原支付密码',
            'new_pay_password' => '新支付密码',
            'new_pay_password_confirm' => '确认支付密码',
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        //用户手机注册
        $scenarios['mobile_register'] = ['c_user_name', 'c_mobile', 'c_login_random', 'c_auth_key', 'c_access_token', 'c_mobile_verify', 'c_user_group_id', 'c_status', 'c_create_type', 'c_reg_date', 'c_create_time', 'new_password', 'new_password_confirm'];
        //用户邮箱注册
        $scenarios['email_register'] = ['c_user_name', 'c_email', 'c_login_random', 'c_auth_key', 'c_access_token', 'c_email_verify', 'c_user_group_id', 'c_status', 'c_create_type', 'c_reg_date', 'c_create_time', 'new_password', 'new_password_confirm'];
        //管理员新增用户
        $scenarios['system_register'] = ['c_user_name', 'c_mobile', 'c_email', 'c_login_random', 'c_auth_key', 'c_access_token', 'c_mobile_verify', 'c_email_verify', 'c_user_group_id', 'c_system_group_id', 'c_status', 'c_create_type', 'c_reg_date', 'c_create_time', 'new_password', 'new_password_confirm'];
        //设置登录密码
        $scenarios['setting-password'] = ['new_password', 'new_password_confirm'];
        //验证原登录密码 再设置新登录密码
        $scenarios['change-password'] = ['old_password', 'new_password', 'new_password_confirm'];
        //验证原登录密码 再设置新支付密码
        $scenarios['setting-pay-password'] = ['old_password', 'new_pay_password', 'new_pay_password_confirm'];
        //验证原支付密码 再设置新支付密码
        $scenarios['change-pay-password'] = ['old_pay_password', 'new_pay_password', 'new_pay_password_confirm'];
        //验证原登录密码
        $scenarios['validate-password'] = ['old_password'];
        return $scenarios;
    }

    public function validateLoginPassword($attribute) {
        if (!$this->hasErrors()) {
            if ($this->c_login_password != self::generatePassword($this->old_password, $this->c_login_random)) {
                $this->addError($attribute, Yii::t('common', Common::PASSWORD_OLD_CHECK_FAIL));
            }
        }
    }

    public function validatePayPassword($attribute) {
        if (!$this->hasErrors()) {
            if ($this->c_pay_password != self::generatePassword($this->old_pay_password, $this->c_pay_random)) {
                $this->addError($attribute, '原支付密码验证失败');
            }
        }
    }

    public function getSystemRoute() {
        if ($this->_system_route) {
            return $this->_system_route;
        }
        $data = static::getDb()->cache(function ($db) {
            $sql = 'SELECT c.c_route FROM t_system_group AS a LEFT JOIN t_system_group_node AS b ON a.c_id=b.c_group_id LEFT JOIN t_system_route AS c ON b.c_route_id=c.c_id WHERE a.c_status=1 AND b.c_status=1 AND a.c_id=' . $this->c_system_group_id;
            return $db->createCommand($sql)->queryAll();
        });
        $array = [];
        foreach ($data as $v) {
            $array[] = $v['c_route'];
        }
        $this->_system_route = $array;
        return $array;
    }

    public function getSystemGroup() {
        return $this->hasOne(SystemGroup::className(), ['c_id' => 'c_system_group_id']);
    }

    public function getUserGroup() {
        return $this->hasOne(UserGroup::className(), ['c_id' => 'c_user_group_id']);
    }

    public function getUserAcount() {
        return $this->hasOne(UserAcount::className(), ['c_user_id' => 'c_id']);
    }

    public function getUserProfile() {
        return $this->hasOne(UserProfile::className(), ['c_user_id' => 'c_id']);
    }

    /**
     * 设置登录密码
     * @return boolean
     */
    public function updateLoginPassword() {
        if ($this->validate()) {
            $this->settingLoginPassword();
            return $this->save(false); //取消第二次验证
        }
        return false;
    }

    /**
     * 设置支付密码
     * @return boolean
     */
    public function updatePayPassword() {
        if ($this->validate()) {
            $random_str = Yii::$app->security->generateRandomString(4);
            $this->c_pay_random = $random_str;
            $this->c_pay_password = self::generatePassword($this->new_pay_password, $random_str);
            return $this->save(false); //取消第二次验证
        }
        return false;
    }

    /**
     * 关闭支付密码
     * @return boolean
     */
    public function closePayPassword() {
        if ($this->validate()) {
            $this->c_pay_random = '';
            $this->c_pay_password = '';
            return $this->save(false); //取消第二次验证
        }
        return false;
    }

    /**
     * 填充密码
     * @param type $password
     */
    public function settingLoginPassword() {
        $random_str = Yii::$app->security->generateRandomString(4);
        $this->c_login_random = $random_str;
        $this->c_login_password = self::generatePassword($this->new_password, $random_str);
    }

    /**
     * 填充支付密码
     * @param type $password
     */
    public function settingPayPassword() {
        $random_str = Yii::$app->security->generateRandomString(4);
        $this->c_pay_random = $random_str;
        $this->c_pay_password = self::generatePassword($this->new_pay_password, $random_str);
    }

    /**
     * 检测密码
     * @param type $password
     * @param type $random_str
     * @return type
     */
    public static function generatePassword($password, $random_str) {
        return md5(md5($password) . $random_str);
    }

    public static function findByUsername($username) {
        return User::findOne(['c_user_name' => $username, 'c_status' => self::STATUS_YES]);
    }

    public static function findByMobile($mobile) {
        return User::findOne(['c_mobile' => $mobile, 'c_mobile_verify' => self::STATUS_YES, 'c_status' => self::STATUS_YES]);
    }

    public static function findByEmail($email) {
        return User::findOne(['c_email' => $email, 'c_email_verify' => self::STATUS_YES, 'c_status' => self::STATUS_YES]);
    }

    public static function existUsername($username) {
        return User::findOne(['c_user_name' => $username]);
    }

    public static function existMobile($mobile) {
        return User::findOne(['c_mobile' => $mobile]);
    }

    public static function existEmail($email) {
        return User::findOne(['c_email' => $email]);
    }

    public static function findByMobileOrEmail($username) {
        if (strstr($username, '@') !== false) {
            return User::findByEmail($username);
        } elseif (Util::checkMobile($username)) {
            return User::findByMobile($username);
        }
        return null;
    }

    /**
     * 查询token是否存在  调用认证的函数 yii\filters\auth\QueryParamAuth
     * @param type $token
     * @param type $type
     * @return type
     */
    public function loginByAccessToken($token, $type) {
        return User::findIdentityByAccessToken($token, $type);
    }

    /**
     * 生成 token
     */
    public function generateApiToken() {
        $this->c_access_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * 校验api_token是否有效
     */
    public static function apiTokenIsValid($token) {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['api_token_expire'];
        return $timestamp + $expire >= time();
    }

    /* start 抽象方法必须存在 */

    public static function findIdentity($id) {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        if (static::apiTokenIsValid($token)) {
            return User::findOne(['c_access_token' => $token, 'c_status' => self::STATUS_YES]);
        } else {
            throw new \yii\web\UnauthorizedHttpException('token is invalid.');
        }
    }

    public function getId() {
        return $this->c_id;
    }

    public function getAuthKey() {
        return $this->c_auth_key;
    }

    public function validateAuthKey($authKey) {
        return $this->c_auth_key === $authKey;
    }

    /* end 抽象方法 */

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if (in_array($this->scenario, ['system_register'])) {
                if ($this->c_email) {
                    if ($this->c_email_verify == self::STATUS_NO) {
                        $this->c_email_verify = self::STATUS_WAIT;
                    }
                } else {
                    $this->c_email_verify = self::STATUS_NO;
                }
                if ($this->c_mobile) {
                    if ($this->c_mobile_verify == self::STATUS_NO) {
                        $this->c_mobile_verify = self::STATUS_WAIT;
                    }
                } else {
                    $this->c_mobile_verify = self::STATUS_NO;
                }
                $this->c_create_type = self::CREATE_ADMIN; //后台创建用户
                $this->c_reg_date = strtotime(date('Y-m-d'));
                $this->c_reg_ip = ip2long(Yii::$app->getRequest()->getUserIP());
                $this->c_last_login_time = time();
                $this->c_create_time = time();
                $this->settingLoginPassword();
            }
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
            UserAcount::addUserAcount($this->c_id);
            UserProfile::addUserProfile($this->c_id);
        }
    }

}
