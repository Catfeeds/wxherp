<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\extensions\Util;
use common\extensions\Tree;

class _CommonModel extends \yii\db\ActiveRecord {

    //广告组件
    const OBJECT_AD = 1; // 广告缩略图
    const OBJECT_AD_MORE = 11; // 广告相册
    //文章组件
    const OBJECT_ARTICLE = 2; // 文章缩略图
    const OBJECT_ARTICLE_MORE = 21; // 文章相册
    const OBJECT_ARTICLE_EDITOR = 22; // 编辑器图片与文件
    //文章类别组件
    const OBJECT_ARTICLE_CATEGORY = 3; // 文章类别缩略图
    const OBJECT_ARTICLE_CATEGORY_MORE = 31; // 文章类别相册
    //链接组件
    const OBJECT_LINK = 4; // 链接缩略图
    const OBJECT_LINK_MORE = 41; // 链接相册
    //活动组件
    const OBJECT_EVENT = 5; // 活动缩略图
    const OBJECT_EVENT_MORE = 51; // 活动相册
    const OBJECT_EVENT_EDITOR = 52; // 编辑器图片与文件
    //上传控件字段名
    const UPLOAD_EDITOR_FIELD_NAME = 'editor';
    const UPLOAD_PICTURE_FIELD_NAME = 'picture';
    const UPLOAD_FILE_FIELD_NAME = 'file';
    //接收上传内容默认字段名
    const PICTURE_FIELD_NAME = 'get_picture';
    const FILE_MORE_FILED_NAME = 'get_file_more';
    const FILE_FIELD_NAME = 'get_file';
    //编辑器默认字段名
    const EDITOR_FIELD_NAME = 'editor_content';
    //常用状态
    const KEY_STATUS_NORMAL_INVALID = 1; // 1正常 2无效   
    const KEY_STATUS_YES_NO = 2; // 1是 2否
    const KEY_STATUS_OPEN_CLOSE = 2; // 1开启 2关闭
    const KEY_STATUS_VERIFY = 3; //1已验证 2未绑定 3待验证
    const KEY_STATUS_RESULT = 4; //1成功 2失败 3未发送
    //状态类型
    const STATUS_YES = 1; // 正常
    const STATUS_NO = 2; // 无效
    const STATUS_WAIT = 3; // 等待
    //删除类型
    const DELETE_YES = 1; // 已删除
    const DELETE_NO = 2; // 正常
    //操作类型
    const OPERATION_ADD = 1; // 新增
    const OPERATION_UPDATE = 2; // 更新
    const OPERATION_DELETE = 3; // 删除
    //来源类型
    const CREATE_PC = 1; // PC
    const CREATE_H5 = 2; // H5
    const CREATE_IOS = 3; // IOS
    const CREATE_ANDRIOD = 4; // Andriod
    const CREATE_API = 7; // API
    const CREATE_OTHER = 8; // 其他
    const CREATE_ADMIN = 9; // 平台
    //分割字符串
    const SELECT_STRING = ' ├ ';

    /**
     * 按sort排序查找
     * @param array $where
     * @param boolean $get_array
     * @param int $limit
     * @return object||array
     */
    public static function findSort($where = null, $get_array = false, $limit = null) {
        $model = static::find();
        $model->orderBy(['c_sort' => SORT_DESC]);
        if ($where) {
            $model->where($where);
        }
        if ($limit) {
            $model->limit($limit);
        }
        if ($get_array) {
            return $model->asArray()->all();
        }
        return $model->all();
    }

    public static function findSortCache($where = null, $get_array = false, $limit = null, $cache_time = 0) {
        $name = md5(get_called_class() . json_encode(func_get_args()));
        $data = self::getCache($name);
        if (empty($data)) {
            $data = static::findSort($where, $get_array, $limit);
            self::setCache($name, $data, $cache_time);
        }
        return $data;
    }

    /**
     * 按id 排序查找
     * @param array $where
     * @param boolean $get_array
     * @param int $limit
     * @return object||array
     */
    public static function findId($where = null, $get_array = false, $limit = null) {
        $model = static::find();
        $model->orderBy(['c_id' => SORT_DESC]);
        if ($where) {
            $model->where($where);
        }
        if ($limit) {
            $model->limit($limit);
        }
        if ($get_array) {
            return $model->asArray()->all();
        }
        return $model->all();
    }

    public static function findIdCache($where = null, $get_array = false, $limit = null, $cache_time = 0) {
        $name = md5(get_called_class() . json_encode(func_get_args()));
        $data = self::getCache($name);
        if (empty($data)) {
            $data = static::findId($where, $get_array, $limit);
            self::setCache($name, $data, $cache_time);
        }
        return $data;
    }

    public static function findOneCache($id, $cache_time = 0) {
        $name = md5(get_called_class() . json_encode(func_get_args()));
        $data = self::getCache($name);
        if (empty($data)) {
            $data = static::findOne($id);
            self::setCache($name, $data, $cache_time);
        }
        return $data;
    }

    /**
     * 返回某列数据
     * @param type $value_name
     * @param type $where
     * @return type
     */
    public static function getColumn($value_name, $where = null) {
        $data = static::findId($where, true);
        return ArrayHelper::getColumn($data, $value_name);
    }

    /**
     * 返回制定的键对值
     * @param array $where
     * @param string $value_name
     * @param string $key_name
     * @return array
     */
    public static function getKeyValue($where = null, $value_name = 'c_title', $key_name = 'c_id') {
        $data = static::findId($where, true);
        return ArrayHelper::map($data, $key_name, $value_name);
    }

    public static function getKeyValueCache($where = null, $value_name = 'c_title', $key_name = 'c_id', $cache_time = 0) {
        $name = md5(get_called_class() . json_encode(func_get_args()));
        $data = self::getCache($name);
        if (empty($data)) {
            $data = static::getKeyValue($where, $value_name, $key_name);
            self::setCache($name, $data, $cache_time);
        }
        return $data;
    }

    /**
     * 返回制定的键对值
     * @param array $where
     * @param string $default_value_field
     * @param string $default_key_field
     * @return array
     */
    public static function getKeyValueSort($where = null, $default_value_field = 'c_title', $default_key_field = 'c_id') {
        $data = static::findSort($where, true);
        return ArrayHelper::map($data, $default_key_field, $default_value_field);
    }

    public static function getKeyValueSortCache($where = null, $value_name = 'c_title', $key_name = 'c_id', $cache_time = 0) {
        $name = md5(get_called_class() . json_encode(func_get_args()));
        $data = self::getCache($name);
        if (empty($data)) {
            $data = static::getKeyValueSort($where, $value_name, $key_name);
            self::setCache($name, $data, $cache_time);
        }
        return $data;
    }

    /**
     * 返回树形数组
     * @param type $where
     * @return type
     */
    public static function getTree($where = null, $orderby = ['c_parent_id' => SORT_ASC, 'c_sort' => SORT_DESC]) {
        $model = static::find();
        $model->orderBy($orderby);
        if ($where) {
            $model->where($where);
        }
        $data = $model->asArray()->all();
        return Tree::getTree($data);
    }

    public static function getTreeCache($where = null, $cache_time = 0, $orderby = ['c_parent_id' => SORT_ASC, 'c_sort' => SORT_DESC]) {
        $name = md5(get_called_class() . json_encode(func_get_args()));
        $data = self::getCache($name);
        if (empty($data)) {
            $data = static::getTree($where, $orderby);
            self::setCache($name, $data, $cache_time);
        }
        return $data;
    }

    /**
     * 格式化下拉数据
     * @param type $default
     * @param type $where
     * @param type $show_layer
     */
    public static function formatDropDownList($where = null, $show_layer = 2) {
        static $array = [];
        $data = static::getTree($where);
        foreach ($data as $item) {
            static::dropDownList($array, $item, $show_layer);
        }
        return $array;
    }

    /**
     * 格式化下拉数据
     * @param type $default
     * @param type $where
     * @param type $show_layer
     */
    public static function formatDropDownListCache($where = null, $show_layer = 2) {
        static $array = [];
        $data = static::getTreeCache($where);
        foreach ($data as $item) {
            static::dropDownList($array, $item, $show_layer);
        }
        return $array;
    }

    protected static function dropDownList(&$array, $item, $show_layer, $current_layer = 1) {
        $array[$item['c_id']] = str_repeat(self::SELECT_STRING, $current_layer - 1) . $item['c_title'];
        if (isset($item['sub']) && $current_layer < $show_layer) {
            foreach ($item['sub'] as $v) {
                static::dropDownList($array, $v, $show_layer, $current_layer + 1);
            }
        }
    }

    //获取所有子类ID
    public static function getSub($id) {
        static $array = [];
        $data = static::findSort(['c_parent_id' => $id]);
        if ($data) {
            foreach ($data as $v) {
                $array[] = $v['c_id'];
                static::getSub($v['c_id']);
            }
        }
        return $array;
    }

    //检查父ID是否在子类数组中
    public static function checkSub($id, $parent_id = 0) {
        $sub = static::getSub($id);
        return in_array($parent_id, $sub);
    }

    /**
     * 检测插入数据时有错误将会弹出
     * @param type $model
     */
    public static function checkModel($model) {
        $error = $model->getFirstErrors();
        if ($error && YII_ENV_DEV) {
            Util::alert(array_values($error)[0]);
        }
    }

    public static function systemLog($e) {
        SystemLog::add($e->getMessage() . $e->getFile() . $e->getLine());
    }

    public static function getCache($name) {
        return Yii::$app->cache->get($name);
    }

    public static function setCache($name, $data, $cache_time = 0) {
        return Yii::$app->cache->set($name, $data, $cache_time);
    }

    public static function getObjectMore() {
        return [self::OBJECT_AD_MORE, self::OBJECT_ARTICLE_CATEGORY_MORE, self::OBJECT_ARTICLE_MORE, self::OBJECT_EVENT_MORE, self::OBJECT_LINK_MORE];
    }

    /**
     * 分页
     * @return type
     */
    public static function getPageSize() {
        return [5 => '5 条', 10 => '10 条', 15 => '15 条', 20 => '20 条', 30 => '30 条', 40 => '40 条', 50 => '50条', 100 => '100 条', 150 => '150 条', 200 => '200 条'];
    }

    /**
     * 获取来源类型
     * @param type $type
     * @return type
     */
    public static function getCreateType($type = null) {
        $array = [
            self::CREATE_PC => 'PC',
            self::CREATE_H5 => 'H5',
            self::CREATE_IOS => 'IOS',
            self::CREATE_ANDRIOD => 'Andriod',
            self::CREATE_API => 'API',
            self::CREATE_OTHER => '其他',
            self::CREATE_ADMIN => '平台'
        ];
        return self::getCommonStatus($array, $type);
    }

    /**
     * 获取组件类型
     * @param type $type
     * @return type
     */
    public static function getObjectType($type = null) {
        $array = [
            self::OBJECT_AD => '广告缩略图',
            self::OBJECT_AD_MORE => '广告相册',
            self::OBJECT_ARTICLE => '文章缩略图',
            self::OBJECT_ARTICLE_MORE => '文章相册',
            self::OBJECT_ARTICLE_CATEGORY => '文章类别缩略图',
            self::OBJECT_ARTICLE_CATEGORY_MORE => '文章类别相册',
            self::OBJECT_LINK => '链接缩略图',
            self::OBJECT_LINK_MORE => '链接相册'
        ];
        return self::getCommonStatus($array, $type);
    }

    /**
     * 获取操作类型
     * @param type $type
     * @return type
     */
    public static function getOperationType($type = null) {
        $array = [
            self::OPERATION_ADD => '新增',
            self::OPERATION_UPDATE => '编辑',
            self::OPERATION_DELETE => '删除'
        ];
        return self::getCommonStatus($array, $type);
    }

    /**
     * 获取删除类型
     * @param type $type
     * @return type
     */
    public static function getDeleteType($type = null) {
        $array = [
            self::DELETE_YES => '已删除',
            self::DELETE_NO => '正常',
        ];
        return self::getCommonStatus($array, $type);
    }

    /**
     * 通用自定义数组显示状态
     * @param type $array
     * @param type $type
     * @return boolean
     */
    public static function getCommonStatus($array, $type = null) {
        if (is_null($type)) {
            return $array;
        } elseif (isset($array[$type])) {
            return $array[$type];
        }
        return false;
    }

    public static function getStatusText($type = null, $key = self::KEY_STATUS_NORMAL_INVALID) {
        $array = self::_getStatusListText($key);
        if (is_null($type)) {
            return $array;
        } elseif (isset($array[$type])) {
            return $array[$type];
        }

        return false;
    }

    public static function getStatusIcon($type = null, $key = self::KEY_STATUS_NORMAL_INVALID) {
        $array = self::_getStatusListIcon($key);
        if (is_null($type)) {
            return $array;
        } elseif (isset($array[$type])) {
            return '<i class="' . $array[$type][2] . ' fa fa-' . $array[$type][1] . '" title="' . $array[$type][0] . '"></i>';
        }
        return false;
    }

    /**
     * 获取是否状态
     * @param type $type
     * @return type
     */
    public static function getStatusYesNoText($type = null) {
        return self::getStatusText($type, self::KEY_STATUS_YES_NO);
    }

    public static function getStatusYesNoIcon($type = null) {
        return self::getStatusIcon($type, self::KEY_STATUS_YES_NO);
    }

    /**
     * 获取打开关闭状态
     * @param type $type
     * @return type
     */
    public static function getStatusOpenCloseText($type = null) {
        return self::getStatusText($type, self::KEY_STATUS_OPEN_CLOSE);
    }

    public static function getStatusOpenCloseIcon($type = null) {
        return self::getStatusIcon($type, self::KEY_STATUS_OPEN_CLOSE);
    }

    /**
     * 获取验证状态
     * @param type $type
     * @return type
     */
    public static function getStatusVerifyText($type = null) {
        return self::getStatusText($type, self::KEY_STATUS_VERIFY);
    }

    public static function getStatusVerifyIcon($type = null) {
        return self::getStatusIcon($type, self::KEY_STATUS_VERIFY);
    }

    /**
     * 获取结果状态
     * @param type $type
     * @param type $key
     * @return type
     */
    public static function getStatusResultText($type = null) {
        return self::getStatusText($type, self::KEY_STATUS_RESULT);
    }

    public static function getStatusResultIcon($type = null) {
        return self::getStatusIcon($type, self::KEY_STATUS_RESULT);
    }

    private static function _getStatusListIcon($key) {
        $array = [
            self::KEY_STATUS_NORMAL_INVALID => [self::STATUS_YES => ['正常', 'check-circle', 'text-success'], self::STATUS_NO => ['无效', 'times-circle', 'text-danger']],
            self::KEY_STATUS_YES_NO => [self::STATUS_YES => ['是', 'check-circle', 'text-success'], self::STATUS_NO => ['否', 'times-circle', 'text-danger']],
            self::KEY_STATUS_OPEN_CLOSE => [self::STATUS_YES => ['开启', 'check-circle', 'text-success'], self::STATUS_NO => ['关闭', 'times-circle', 'text-danger']],
            self::KEY_STATUS_VERIFY => [self::STATUS_YES => ['已验证', 'check-circle', 'text-success'], self::STATUS_NO => ['未绑定', 'times-circle', 'text-danger'], self::STATUS_WAIT => ['待验证', 'hourglass', 'text-primary']],
            self::KEY_STATUS_RESULT => [self::STATUS_YES => ['成功', 'check-circle', 'text-success'], self::STATUS_NO => ['失败', 'times-circle', 'text-danger'], self::STATUS_WAIT => ['未发送', 'hourglass', 'text-primary']]
        ];
        return isset($array[$key]) ? $array[$key] : false;
    }

    private static function _getStatusListText($key) {
        $array = [
            self::KEY_STATUS_NORMAL_INVALID => [self::STATUS_YES => '正常', self::STATUS_NO => '无效'],
            self::KEY_STATUS_YES_NO => [self::STATUS_YES => '是', self::STATUS_NO => '否'],
            self::KEY_STATUS_OPEN_CLOSE => [self::STATUS_YES => '开启', self::STATUS_NO => '关闭'],
            self::KEY_STATUS_VERIFY => [self::STATUS_YES => '已验证', self::STATUS_NO => '未绑定', self::STATUS_WAIT => '待验证'],
            self::KEY_STATUS_RESULT => [self::STATUS_YES => '成功', self::STATUS_NO => '失败', self::STATUS_WAIT => '未发送']
        ];
        return isset($array[$key]) ? $array[$key] : false;
    }

}
