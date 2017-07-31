<?php

namespace common\controllers;

use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use common\extensions\Captcha;
use common\extensions\Util;
use common\messages\Common;
use common\forms\UploadForm;
use common\models\Upload;
use common\models\UserOperationLog;
use common\models\_CommonModel;

class _CommonController extends Controller {

    //母版类型
    const MAIN_LAYOUT = 1; // 无导航（常用于登录或Ajax弹出窗口）
    const NAV_LAYOUT = 2; // 有导航（常用于列表）
    const USER_LAYOUT = 3; // 用户中心

    /**
     * 获取验证码
     */

    public function actionCaptcha() {
        $object = new Captcha();
        $object->config();
        $object->make();
    }

    /**
     * 公共模块创建
     * @param type $model 模型
     * @param type $data 自定义数据格式 [模型名称=>数据数组] 如: [Ad => ['c_title'=>'test','c_status'=>1]] 默认是接收POST数据
     * @param type $user_type 平台用户类型
     * @return boolean
     */
    protected function commonCreate($model, $data = null, $user_type = _CommonModel::TYPE_ADMIN) {
        if (is_null($data)) {
            $data = Yii::$app->request->post();
        }
        if ($model->load($data)) {
            if (array_key_exists('c_create_time', $model->attributes)) {
                $model->c_create_time = time();
            }
            if ($model->validate()) {
                $result = $model->save();

                $log['c_type'] = _CommonModel::OPERATION_ADD;
                $log['c_status'] = $result ? _CommonModel::STATUS_YES : _CommonModel::STATUS_NO;
                $log['c_object_id'] = $model->c_id;
                $log['c_data_add'] = json_encode($model->attributes, JSON_UNESCAPED_UNICODE);
                $log['c_data_before'] = json_encode(null, JSON_UNESCAPED_UNICODE);
                $log['c_user_type'] = $user_type;
                $this->userLog($log);

                if ($result) {
                    $this->flashSuccess('新增操作成功');
                    return true;
                } else {
                    $this->flashError('新增操作失败', $model);
                    return false;
                }
            } else {
                $this->flashError('新增数据验证未通过', $model);
                return false;
            }
        } else {
            $this->flashError(null, Yii::t('common', Common::SYSTEM_LOAD_FAIL));
            return false;
        }
    }

    /**
     * 公共模块更新
     * @param type $model 模型
     * @param type $data 自定义数据格式 [模型名称=>数据数组] 如: [Ad => ['c_title'=>'test','c_status'=>1]] 默认是接收POST数据
     * @param type $user_type 平台用户类型
     * @return boolean
     */
    protected function commonUpdate($model, $data = null, $user_type = _CommonModel::TYPE_ADMIN) {
        $data_before = $model->attributes; //在本次更新之前的数据
        if (is_null($data)) {
            $data = Yii::$app->request->post();
        }
        if ($model->load($data)) {
            if ($model->validate()) {
                $result = $model->save();

                $log['c_type'] = _CommonModel::OPERATION_UPDATE;
                $log['c_status'] = $result ? _CommonModel::STATUS_YES : _CommonModel::STATUS_NO;
                $log['c_object_id'] = $model->c_id;
                $log['c_data_add'] = json_encode($model->attributes, JSON_UNESCAPED_UNICODE);
                $log['c_data_before'] = json_encode($data_before, JSON_UNESCAPED_UNICODE);
                $log['c_user_type'] = $user_type;
                $this->userLog($log);

                if ($result) {
                    $this->flashSuccess('更新操作成功');
                    return true;
                } else {
                    $this->flashError('更新操作失败', $model);
                    return false;
                }
            } else {
                $this->flashError('更新数据验证未通过', $model);
                return false;
            }
        } else {
            $this->flashError(Yii::t('common', Common::SYSTEM_LOAD_FAIL));
            return false;
        }
    }

    /**
     * 按自定义字段更新字段值 可批量操作 $id, $value, $field = 'c_status'
     * @param type $model_name 模型名称
     * @param type $update 更新数组
     * @param type $where 查询条件数组
     * @param type $user_type 平台用户类型
     * @return boolean
     */
    protected function commonUpdateField($model_name, $update, $where, $user_type = _CommonModel::TYPE_ADMIN) {
        $result = $model_name::updateAll($update, $where);

        $log['c_type'] = _CommonModel::OPERATION_UPDATE;
        $log['c_status'] = $result ? _CommonModel::STATUS_YES : _CommonModel::STATUS_NO;
        $log['c_object_id'] = 0;
        $log['c_data_add'] = json_encode(ArrayHelper::merge($update, $where), JSON_UNESCAPED_UNICODE);
        $log['c_data_before'] = json_encode(null, JSON_UNESCAPED_UNICODE);
        $log['c_user_type'] = $user_type;
        $this->userLog($log);

        if ($result) {
            $this->flashSuccess('更新操作成功');
            return true;
        } else {
            $this->flashError('更新操作失败');
            return false;
        }
    }

    /**
     * 删除操作 可批量删除
     * @param type $model_name 模型名称
     * @param type $id 
     * @param type $user_type 平台用户类型
     * @return boolean
     */
    protected function commonDelete($model_name, $id = null, $user_type = _CommonModel::TYPE_ADMIN) {
        if ($id === null) {
            $id = explode(',', Yii::$app->request->post('id'));
        } else {
            $id = (int) $id;
        }
        if ($id) {
            $list = $model_name::find()->where(['c_id' => $id])->all();
            foreach ($list as $model) {
                $result = $model->delete();

                $log['c_type'] = _CommonModel::OPERATION_DELETE;
                $log['c_status'] = $result ? _CommonModel::STATUS_YES : _CommonModel::STATUS_NO;
                $log['c_object_id'] = $model->c_id;
                $log['c_data_add'] = json_encode($model->attributes, JSON_UNESCAPED_UNICODE);
                $log['c_data_before'] = json_encode(null, JSON_UNESCAPED_UNICODE);
                $log['c_user_type'] = $user_type;
                $this->userLog($log);

                if ($model->getErrors()) {
                    $this->flashError('删除操作失败', $model);
                    return false;
                }
            }
            $this->flashSuccess('删除操作成功');
            return true;
        } else {
            $this->flashError('删除ID参数无效');
            return false;
        }
    }

    /**
     *  加入操作日志
     * @param type $type 操作类型 1新增 2编辑 3删除
     * @param type $status 操作结果状态 1成功 2失败
     * @param type $id 操作对象的ID
     * @param type $data_before 在本次更新或删除之前的数据
     * @param type $data_add 本次新增或更新的数据
     */
    protected function userLog($data) {
        if (isset(Yii::$app->params['user_log_status']) && Yii::$app->params['user_log_status'] === '1') {
            $data['c_route'] = Yii::$app->controller->getRoute();
            UserOperationLog::add($data);
        }
    }

    public function flashError($msg = '操作失败', $model = null) {
        if ($model) {
            $error = $model->getFirstErrors();
            if ($error) {
                $msg = array_values($error)[0];
            }
        }
        Yii::$app->getSession()->setFlash('error', $msg);
    }

    public function flashSuccess($msg = '操作成功') {
        Yii::$app->getSession()->setFlash('success', $msg);
    }

    /**
     *  Ajax返回状态信息
     * @param type $msg 信息提示
     * @param type $type 
     * 1  弹出信息，3秒后自动消失 
     * 2  弹出信息，2秒后自动重定向，URL参数必填
     * 3  弹出信息，2秒后自动重载当前页
     * 4  弹出信息，2秒后自动返回上一页
     * 5  无信息提示，自动重定向，URL参数必填
     * 6  无信息提示，自动重载当前页
     * 7  无信息提示，自动返回上一页
     * @param type $url 重定向连接
     */
    protected function ajaxSuccess($msg = null, $type = 3, $url = '') {
        if (empty($msg)) {
            $msg = Yii::t('common', Common::SYSTEM_OPERATION_SUCCESS);
        }
        $array['status'] = 0;
        $array['type'] = $type;
        $array['msg'] = $msg;
        $array['url'] = $url;
        self::jsonEcho($array);
    }

    /**
     *  Ajax返回状态信息
     * @param type $msg 信息提示
     * @param type $type 
     * 0  关闭弹窗
     * 1  弹出信息，2秒后自动消失 
     * 2  弹出信息，自动重定向，URL参数必填
     * 3  弹出信息，自动重载当前页
     * 4  弹出信息，自动返回上一页
     * 5  无信息提示，自动重定向，URL参数必填
     * 6  无信息提示，自动重载当前页
     * 7  无信息提示，自动返回上一页
     * @param type $url 重定向连接
     */
    protected function ajaxError($msg = null, $type = 1, $url = '') {
        if (empty($msg)) {
            $msg = Yii::t('common', Common::SYSTEM_OPERATION_FAIL);
        }
        $array['status'] = 1;
        $array['type'] = $type;
        $array['msg'] = $msg;
        $array['url'] = $url;
        self::jsonEcho($array);
    }

    /**
     * JSON 
     * @param type $message
     * @param type $error 0成功 1错误 
     */
    protected static function jsonFormat($message = '', $error = 1) {
        if (empty($message)) {
            $message = $error ? '操作失败' : '操作成功';
        }
        self::jsonEcho(['error' => $error, 'message' => $message]);
    }

    protected static function jsonEcho($array) {
        echo json_encode($array);
        Yii::$app->end();
    }

    /**
     * 公共图片上传文件
     * @param type $user_type 用户类型 1后台 2前台
     */
    protected function pictureUpload($user_type = _CommonModel::TYPE_ADMIN) {
        try {
            if (Yii::$app->request->isPost) {
                $object_id = (int) Yii::$app->request->post('object_id'); //对象ID
                $object_type = (int) Yii::$app->request->post('object_type'); //对象项目类型

                $model = new UploadForm();
                $model->picture = UploadedFile::getInstance($model, _CommonModel::UPLOAD_PICTURE_FIELD_NAME); //参数picture是指input上传控件name

                if ($model->picture && !in_array($model->picture->extension, Yii::$app->params['image_extensions'])) {
                    self::jsonFormat('只允许上传文件的后缀为 ' . implode(',', Yii::$app->params['image_extensions']));
                }

                if ($model->validate()) {
                    $info = Upload::getUploadInfo($model->picture->baseName, $model->picture->extension);
                    $file_path = Upload::getUploadPath() . $info['path']; //文件上传的路径
                    $file_url = $info['url']; //图片路径
                    Util::createDirList($file_path); //生成目录
                    $result = $model->picture->saveAs($file_path); //保存上传文件

                    if ($result === true) {
                        $data = [];
                        $data['c_name'] = $model->picture->name;
                        $data['c_size'] = $model->picture->size;
                        $data['c_path'] = $file_url;
                        $data['c_extension'] = $model->picture->extension;
                        $data['c_object_id'] = $object_id;
                        $data['c_object_type'] = $object_type;
                        $data['c_user_type'] = $user_type;
                        $data['c_type'] = 1; //文件类型 1图片 2附件
                        Upload::add($data);
                        self::jsonEcho(['error' => 0, 'thumb' => Upload::getThumb($file_url), 'fileurl' => $file_url]);
                    }
                } else {
                    $error = $model->getFirstErrors();
                    $message = $error ? array_values($error)[0] : '规则验证失败，而且错误信息为空';
                    self::jsonFormat($message);
                }
            } else {
                self::jsonFormat('上传失败');
            }
        } catch (Exception $exc) {
            self::jsonFormat($exc->getMessage());
        }
    }

    /**
     * 公共上传文件
     * @param type $user_type 用户类型 1后台 2前台
     */
    protected function fileUpload($user_type = _CommonModel::TYPE_ADMIN) {
        try {
            if (Yii::$app->request->isPost) {
                $dir = Yii::$app->request->get('dir'); //获取编辑器上传允许的目录  $config['editor_dir'] = ['image', 'flash', 'media', 'file'];
                $object_id = (int) Yii::$app->request->post('object_id'); //对象ID
                $object_type = (int) Yii::$app->request->post('object_type'); //对象项目类型

                $model = new UploadForm();
                $model->file = UploadedFile::getInstance($model, _CommonModel::UPLOAD_FILE_FIELD_NAME);

                if ($model->file && !in_array($model->file->extension, Yii::$app->params['file_extensions'])) {
                    self::jsonFormat('只允许上传文件的后缀为 ' . implode(',', Yii::$app->params['file_extensions']));
                }

                if ($model->validate()) {
                    $info = Upload::getUploadInfo($model->file->baseName, $model->file->extension);
                    $file_url = $info['url']; //返回上传的URL
                    $file_path = Upload::getUploadPath() . $info['path']; //上传的文件路径
                    $http_url = Upload::getUploadUrl() . $file_url;

                    if ($dir && in_array($dir, Yii::$app->params['editor_dir'])) {
                        $file_url = $dir . '/' . $file_url; //保存上传的URL
                        $file_path = Upload::getUploadPath() . $dir . DIRECTORY_SEPARATOR . $info['path']; //编辑器存放的路径
                        $http_url = Upload::getUploadUrl() . $file_url; //编辑器返回的上传绝对URL
                    }

                    Util::createDirList($file_path); //生成目录
                    $result = $model->file->saveAs($file_path); //保存上传文件

                    if ($result === true) {
                        $data['c_name'] = $model->file->name;
                        $data['c_size'] = $model->file->size;
                        $data['c_path'] = $file_url;
                        $data['c_extension'] = $model->file->extension;
                        $data['c_object_id'] = $object_id;
                        $data['c_object_type'] = $object_type;
                        $data['c_user_type'] = $user_type; //用户类型 1后台 2前台
                        $data['c_type'] = 2; //文件类型 1图片 2附件
                        Upload::add($data);
                        //thumb 缩略图地址 http://file.domain.com/thumb/200_200/2017/02/10/13/f944ff5cffc05852881c6a92f6b8e826.png
                        //fileurl 数据库保存地址 2017/02/10/13/f944ff5cffc05852881c6a92f6b8e826.png
                        //url 图片地址 http://file.domain.com/2017/02/10/13/f944ff5cffc05852881c6a92f6b8e826.png
                        if ($dir) {
                            self::jsonEcho(['error' => 0, 'url' => $http_url]);
                        } else {
                            $thumb = in_array($model->file->extension, Yii::$app->params['image_extensions']) ? Upload::getThumb($file_url) : Upload::getFilePic(); //如果是图片格式就显示缩略图否则就是附件缩略图
                            self::jsonEcho(['error' => 0, 'thumb' => $thumb, 'fileurl' => $file_url]);
                        }
                    }
                } else {
                    $error = $model->getFirstErrors();
                    $message = $error ? array_values($error)[0] : '规则验证失败，而且错误信息为空';
                    self::jsonFormat($message);
                }
            } else {
                self::jsonFormat('上传失败');
            }
        } catch (Exception $exc) {
            self::jsonFormat($exc->getMessage());
        }
    }

}
