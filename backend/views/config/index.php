<?php

use yii\helpers\Url;
use common\models\Config;

$this->title = '网站设置';
?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">基础设置</a></li>
    <li><a href="#tab2" data-toggle="tab">上传设置</a></li>
    <li><a href="#tab3" data-toggle="tab">商城设置</a></li>
    <li><a href="#tab4" data-toggle="tab">邮箱设置</a></li>
    <li><a href="#tab5" data-toggle="tab">短信设置</a></li>
    <li><a href="#tab6" data-toggle="tab">插件设置</a></li>
    <li><a href="#tab7" data-toggle="tab">系统设置</a></li>
</ul>
<form class="form-ajax form-horizontal" action="<?= Url::to(['index']) ?>" method="post" onsubmit="return false;">   
    <div class="box box-primary">
        <div class="box-body tab-content">
            <div class="tab-pane active" id="tab1">
                <div class="form-group">
                    <label class="col-lg-2 control-label">网站域名</label>
                    <div class="col-lg-4">
                        <input data-rule="required;url" class="form-control" type="text" name="site[domian_frontend]" maxlength="50" value="<?= isset($data['site']['domian_frontend']) ? $data['site']['domian_frontend'] : Yii::$app->request->getHostInfo(); ?>">
                    </div>
                    <label class="col-lg-2 control-label">后台域名</label>
                    <div class="col-lg-4">
                        <input data-rule="required;url" class="form-control" type="text" name="site[domian_backend]" maxlength="50" value="<?= isset($data['site']['domian_backend']) ? $data['site']['domian_backend'] : Yii::$app->request->getHostInfo(); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">文件域名</label>
                    <div class="col-lg-4">
                        <input data-rule="required;url" class="form-control" type="text" name="site[domian_file]" maxlength="50" value="<?= isset($data['site']['domian_file']) ? $data['site']['domian_file'] : Yii::$app->request->getHostInfo(); ?>">
                    </div>
                    <label class="col-lg-2 control-label">接口域名</label>
                    <div class="col-lg-4">
                        <input data-rule="required;url" class="form-control" type="text" name="site[domian_api]" maxlength="50" value="<?= isset($data['site']['domian_api']) ? $data['site']['domian_api'] : Yii::$app->request->getHostInfo(); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">网站名称</label>
                    <div class="col-lg-4">
                        <input data-rule="required" class="form-control" type="text" name="site[site_title]" maxlength="255" value="<?= isset($data['site']['site_title']) ? $data['site']['site_title'] : ''; ?>">
                    </div>
                    <label class="col-lg-2 control-label">网站附加标题</label>
                    <div class="col-lg-4">
                        <input class="form-control" type="text" name="site[site_seo]" maxlength="255" value="<?= isset($data['site']['site_seo']) ? $data['site']['site_seo'] : ''; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">网站首页关键词</label>
                    <div class="col-lg-4">
                        <input class="form-control" type="text" name="site[site_keywords]" maxlength="255" value="<?= isset($data['site']['site_keywords']) ? $data['site']['site_keywords'] : ''; ?>">
                    </div>
                    <label class="col-lg-2 control-label">ICP备案序号</label>
                    <div class="col-lg-4">
                        <input class="form-control" type="text" name="site[site_icp]" maxlength="255" value="<?= isset($data['site']['site_icp']) ? $data['site']['site_icp'] : ''; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">网站SEO描述信息</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" rows="3" name="site[site_description]"><?= isset($data['site']['site_description']) ? $data['site']['site_description'] : ''; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">第三方统计代码</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" rows="3" name="site[site_js]"><?= isset($data['site']['site_js']) ? $data['site']['site_js'] : ''; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">联系人</label>
                    <div class="col-lg-4">
                        <input class="form-control" type="text" name="site[site_contact]" maxlength="255" value="<?= isset($data['site']['site_contact']) ? $data['site']['site_contact'] : ''; ?>">
                    </div>
                    <label class="col-lg-2 control-label">手机</label>
                    <div class="col-lg-4">
                        <input class="form-control" type="text" name="site[site_mobile]" maxlength="255" value="<?= isset($data['site']['site_mobile']) ? $data['site']['site_mobile'] : ''; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">客服电话</label>
                    <div class="col-lg-4">
                        <input class="form-control" type="text" name="site[site_phone]" maxlength="255" value="<?= isset($data['site']['site_phone']) ? $data['site']['site_phone'] : ''; ?>">
                    </div>
                    <label class="col-lg-2 control-label">邮箱</label>
                    <div class="col-lg-4">
                        <input data-rule="email" class="form-control" type="text" name="site[site_email]" maxlength="50" value="<?= isset($data['site']['site_email']) ? $data['site']['site_email'] : ''; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">地址</label>
                    <div class="col-lg-4">
                        <input class="form-control" type="text" name="site[site_address]" maxlength="50" value="<?= isset($data['site']['site_address']) ? $data['site']['site_address'] : ''; ?>">
                    </div>
                    <label class="col-lg-2 control-label">微信号</label>
                    <div class="col-lg-4">
                        <input class="form-control" type="text" name="site[site_weixin]" maxlength="255" value="<?= isset($data['site']['site_weixin']) ? $data['site']['site_weixin'] : ''; ?>">
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="tab2">
                <div class="form-group">
                    <label class="col-lg-2 control-label">图片上传开关</label>
                    <div class="col-lg-4">
                        <?php
                        foreach (Config::getStatusOpenCloseText() as $k => $v) {
                            $selectstr = isset($data['upload']['upload_picture_status']) && $data['upload']['upload_picture_status'] == $k ? ' checked="checked"' : '';
                            echo '<label class="radio-inline"><input data-rule="checked" type="radio" name="upload[upload_picture_status]" value="' . $k . '"' . $selectstr . '> ' . $v . '</label>';
                        }
                        ?>
                    </div>
                    <label class="col-lg-2 control-label">附件上传开关</label>
                    <div class="col-lg-4">
                        <?php
                        foreach (Config::getStatusOpenCloseText() as $k => $v) {
                            $selectstr = isset($data['upload']['upload_file_status']) && $data['upload']['upload_file_status'] == $k ? ' checked="checked"' : '';
                            echo '<label class="radio-inline"><input data-rule="checked" type="radio" name="upload[upload_file_status]" value="' . $k . '"' . $selectstr . '> ' . $v . '</label>';
                        }
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">附件下载需要登录</label>
                    <div class="col-lg-4">
                        <?php
                        foreach (Config::getStatusOpenCloseText() as $k => $v) {
                            $selectstr = isset($data['upload']['upload_file_login']) && $data['upload']['upload_file_login'] == $k ? ' checked="checked"' : '';
                            echo '<label class="radio-inline"><input data-rule="checked" type="radio" name="upload[upload_file_login]" value="' . $k . '"' . $selectstr . '> ' . $v . '</label>';
                        }
                        ?>
                    </div>
                    <label class="col-lg-2 control-label">缩略图设置</label>
                    <div class="col-lg-4">
                        <?php
                        foreach (Config::getThumbType() as $k => $v) {
                            $selectstr = isset($data['upload']['upload_thumb_type']) && $data['upload']['upload_thumb_type'] == $k ? ' checked="checked"' : '';
                            echo '<label class="radio-inline"><input data-rule="checked" type="radio" name="upload[upload_thumb_type]" value="' . $k . '"' . $selectstr . '> ' . $v . '</label>';
                        }
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">缩略图宽高</label>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <label>50>= 长 <=500</label><input data-rule="integer" class="form-control" type="text" name="upload[upload_thumb_width]" maxlength="3" value="<?= isset($data['upload']['upload_thumb_width']) ? $data['upload']['upload_thumb_width'] : 200; ?>">
                            </div>
                            <div class="col-lg-6">
                                <label>50>= 宽 <=500</label><input data-rule="integer" class="form-control" type="text" name="upload[upload_thumb_height]" maxlength="3" value="<?= isset($data['upload']['upload_thumb_height']) ? $data['upload']['upload_thumb_height'] : 200; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="tab3">
                <div class="form-group">
                    <label class="col-lg-2 control-label">商品货号前缀</label>
                    <div class="col-lg-4">
                        <input class="form-control" type="text" name="shop[number_prefix]" maxlength="50" value="<?= isset($data['shop']['number_prefix']) ? $data['shop']['number_prefix'] : 'JJ'; ?>">
                    </div>
                    <label class="col-lg-2 control-label">邮箱或手机注册时用户名前缀</label>
                    <div class="col-lg-4">
                        <input class="form-control" type="text" name="shop[username_prefix]" maxlength="50" value="<?= isset($data['shop']['username_prefix']) ? $data['shop']['username_prefix'] : 'JJ'; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">自动取消未支付订单</label>
                    <div class="col-lg-4">
                        <input class="form-control" type="text" name="shop[order_auto_cancel_hour]" maxlength="3" value="<?= isset($data['shop']['order_auto_cancel_hour']) ? $data['shop']['order_auto_cancel_hour'] : 48; ?>">
                        <span class="help-block">默认2天 48小时</span>
                    </div>
                    <label class="col-lg-2 control-label">自动确认收货</label>
                    <div class="col-lg-4">
                        <input class="form-control" type="text" name="shop[order_auto_finish_hour]" maxlength="3" value="<?= isset($data['shop']['order_auto_finish_hour']) ? $data['shop']['order_auto_finish_hour'] : 360; ?>">
                        <span class="help-block">默认15天 360小时</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">自动商品评价</label>
                    <div class="col-lg-4">
                        <input class="form-control" type="text" name="shop[order_auto_comment_hour]" maxlength="3" value="<?= isset($data['shop']['order_auto_comment_hour']) ? $data['shop']['order_auto_comment_hour'] : 720; ?>">
                        <span class="help-block">默认30天 720小时</span>
                    </div>
                    <label class="col-lg-2 control-label">用户收货地址最大数量</label>
                    <div class="col-lg-4">
                        <input class="form-control" type="text" name="shop[user_address_max]" maxlength="3" value="<?= isset($data['shop']['user_address_max']) ? $data['shop']['user_address_max'] : 10; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">发票税率</label>
                    <div class="col-lg-4">
                        <div class="input-group">
                            <input class="form-control" type="text" name="shop[shop_tax]" maxlength="3" value="<?= isset($data['shop']['shop_tax']) ? $data['shop']['shop_tax'] : 0; ?>">
                            <span class="input-group-addon">%</span>
                        </div>
                        <span class="help-block">当买家需要发票的时候就要增加【商品总金额】 * 【税率】的费用</span>
                    </div>
                    <label class="col-lg-2 control-label">评论显示</label>
                    <div class="col-lg-4">
                        <?php
                        $comment = [1 => '即时显示', 2 => '审核后显示'];
                        foreach (Config::getCommonStatus($comment) as $k => $v) {
                            $selectstr = isset($data['shop']['comment_status']) && $data['shop']['comment_status'] == $k ? ' checked="checked"' : '';
                            echo '<label class="radio-inline"><input data-rule="checked" type="radio" name="shop[comment_status]" value="' . $k . '"' . $selectstr . '> ' . $v . '</label>';
                        }
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">创建订单判断商品库存</label>
                    <div class="col-lg-4">
                        <?php
                        foreach (Config::getStatusYesNoText() as $k => $v) {
                            $selectstr = isset($data['shop']['store_status']) && $data['shop']['store_status'] == $k ? ' checked="checked"' : '';
                            echo '<label class="radio-inline"><input type="radio" name="shop[store_status]" value="' . $k . '"' . $selectstr . '> ' . $v . '</label>';
                        }
                        ?>
                        <span class="help-block">如果是则随着商品卖出，库存将动态减少</span>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="tab4">
                <div class="form-group">
                    <label class="col-lg-2 control-label">发送类型</label>
                    <div class="col-lg-4">
                        <?php
                        $email_send_type = [1 => '即时发送', 2 => '队列发送'];
                        foreach (Config::getCommonStatus($email_send_type) as $k => $v) {
                            $selectstr = isset($data['email']['email_send_type']) && $data['email']['email_send_type'] == $k ? ' checked="checked"' : '';
                            echo '<label class="radio-inline"><input data-rule="checked" type="radio" name="email[email_send_type]" value="' . $k . '"' . $selectstr . '> ' . $v . '</label>';
                        }
                        ?>
                    </div>
                    <label class="col-lg-2 control-label">发送邮件方式</label>
                    <div class="col-lg-4">
                        <?php
                        $send_type = [1 => '第三方SMTP方式', 2 => '本地mail邮箱'];
                        foreach (Config::getCommonStatus($send_type) as $k => $v) {
                            $selectstr = isset($data['email']['smtp_type']) && $data['email']['smtp_type'] == $k ? ' checked="checked"' : '';
                            echo '<label class="radio-inline"><input data-rule="checked" class="showhide" data-show="1|smtp_type" data-hide="2|smtp_type" type="radio" name="email[smtp_type]" value="' . $k . '"' . $selectstr . '> ' . $v . '</label>';
                        }
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">发送邮件地址</label>
                    <div class="col-lg-4">
                        <input data-rule="email" class="form-control" type="text" name="email[email_send]" maxlength="50" value="<?= isset($data['email']['email_send']) ? $data['email']['email_send'] : ''; ?>">
                    </div>
                    <label class="col-lg-2 control-label">安全协议</label>
                    <div class="col-lg-4">
                        <?php
                        $email_safe = [0 => '默认', 1 => 'SSL', 2 => 'TLS'];
                        foreach (Config::getCommonStatus($email_safe) as $k => $v) {
                            $selectstr = isset($data['email']['email_safe']) && $data['email']['email_safe'] == $k ? ' checked="checked"' : '';
                            echo '<label class="radio-inline"><input data-rule="checked" type="radio" name="email[email_safe]" value="' . $k . '"' . $selectstr . '> ' . $v . '</label>';
                        }
                        ?>
                    </div>
                </div>
                <div class="smtp_type" style="<?= isset($data['email']['smtp_type']) && $data['email']['smtp_type'] == 1 ? '' : 'display:none'; ?>">
                    <div class="form-group">
                        <label class="col-lg-2 control-label">SMTP地址</label>
                        <div class="col-lg-4">
                            <input class="form-control" type="text" name="email[email_smtp]" maxlength="50" value="<?= isset($data['email']['email_smtp']) ? $data['email']['email_smtp'] : ''; ?>">
                        </div>
                        <label class="col-lg-2 control-label">用户名</label>
                        <div class="col-lg-4">
                            <input class="form-control" type="text" name="email[smtp_user]" maxlength="50" value="<?= isset($data['email']['smtp_user']) ? $data['email']['smtp_user'] : ''; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">密码</label>
                        <div class="col-lg-4">
                            <input class="form-control" type="password" name="email[smtp_password]" maxlength="50" value="<?= isset($data['email']['smtp_password']) ? $data['email']['smtp_password'] : ''; ?>">
                        </div>
                        <label class="col-lg-2 control-label">端口号</label>
                        <div class="col-lg-4">
                            <input class="form-control" type="text" name="email[smtp_port]" maxlength="5" value="<?= isset($data['email']['smtp_port']) ? $data['email']['smtp_port'] : 25; ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">邮箱验证有效期(单位秒)</label>
                    <div class="col-lg-4">
                        <input data-rule="integer" class="form-control" type="text" name="email[email_expire]" maxlength="3" value="<?= isset($data['email']['email_expire']) ? $data['email']['email_expire'] : 86400; ?>">
                    </div>
                    <label class="col-lg-2 control-label">邮箱发送间隔(单位秒)</label>
                    <div class="col-lg-4">
                        <input data-rule="integer" class="form-control" type="text" name="email[email_send_time]" maxlength="3" value="<?= isset($data['email']['email_send_time']) ? $data['email']['email_send_time'] : 60; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">同一IP每天发送总数</label>
                    <div class="col-lg-4">
                        <input data-rule="integer" class="form-control" type="text" name="email[email_ip_count]" maxlength="3" value="<?= isset($data['email']['email_ip_count']) ? $data['email']['email_ip_count'] : 50; ?>">
                    </div>
                    <label class="col-lg-2 control-label">同一用户每天发送总数</label>
                    <div class="col-lg-4">
                        <input data-rule="integer" class="form-control" type="text" name="email[email_send_count]" maxlength="3" value="<?= isset($data['email']['email_send_count']) ? $data['email']['email_send_count'] : 50; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">测试邮件地址</label>
                    <div class="col-lg-4">
                        <input data-rule="email" class="form-control" type="text" name="email[email_test]" maxlength="50" value="<?= isset($data['email']['email_test']) ? $data['email']['email_test'] : ''; ?>">
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="tab5">
                <div class="form-group">
                    <label class="col-lg-2 control-label">发送类型</label>
                    <div class="col-lg-4">
                        <?php
                        $sms_send_type = [1 => '即时发送', 2 => '队列发送'];
                        foreach (Config::getCommonStatus($sms_send_type) as $k => $v) {
                            $selectstr = isset($data['sms']['sms_send_type']) && $data['sms']['sms_send_type'] == $k ? ' checked="checked"' : '';
                            echo '<label class="radio-inline"><input data-rule="checked" type="radio" name="sms[sms_send_type]" value="' . $k . '"' . $selectstr . '> ' . $v . '</label>';
                        }
                        ?>
                    </div>
                    <label class="col-lg-2 control-label">默认短信签名</label>
                    <div class="col-lg-4">
                        <input class="form-control" type="text" name="sms[sms_sign_name]" maxlength="50" value="<?= isset($data['sms']['sms_sign_name']) ? $data['sms']['sms_sign_name'] : ''; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">阿里大于app_key</label>
                    <div class="col-lg-4">
                        <input class="form-control" type="text" name="sms[sms_app_key]" maxlength="50" value="<?= isset($data['sms']['sms_app_key']) ? $data['sms']['sms_app_key'] : ''; ?>">
                    </div>
                    <label class="col-lg-2 control-label">阿里大于app_secret</label>
                    <div class="col-lg-4">
                        <input class="form-control" type="password" name="sms[sms_app_secret]" maxlength="50" value="<?= isset($data['sms']['sms_app_secret']) ? $data['sms']['sms_app_secret'] : ''; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">短信验证有效期(单位秒)</label>
                    <div class="col-lg-4">
                        <input data-rule="integer" class="form-control" type="text" name="sms[sms_expire]" maxlength="3" value="<?= isset($data['sms']['email_expire']) ? $data['sms']['sms_expire'] : 86400; ?>">
                    </div>
                    <label class="col-lg-2 control-label">短信发送间隔(单位秒)</label>
                    <div class="col-lg-4">
                        <input data-rule="integer" class="form-control" type="text" name="sms[sms_send_time]" maxlength="3" value="<?= isset($data['sms']['sms_send_time']) ? $data['sms']['sms_send_time'] : 60; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">同一IP每天发送总数</label>
                    <div class="col-lg-4">
                        <input data-rule="integer" class="form-control" type="text" name="sms[sms_ip_count]" maxlength="3" value="<?= isset($data['sms']['sms_ip_count']) ? $data['sms']['sms_ip_count'] : 50; ?>">
                    </div>
                    <label class="col-lg-2 control-label">同一用户每天发送总数</label>
                    <div class="col-lg-4">
                        <input data-rule="integer" class="form-control" type="text" name="sms[sms_send_count]" maxlength="3" value="<?= isset($data['sms']['sms_send_count']) ? $data['sms']['sms_send_count'] : 50; ?>">
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="tab6">
                <div class="form-group">
                    <label class="col-lg-2 control-label">在线客服开关</label>
                    <div class="col-lg-10">
                        <?php
                        foreach (Config::getStatusOpenCloseText() as $k => $v) {
                            $selectstr = isset($data['plugin']['qq_open']) && $data['plugin']['qq_open'] == $k ? ' checked="checked"' : '';
                            echo '<label class="radio-inline"><input data-rule="checked" class="showhide" data-show="1|qq_list" data-hide="2|qq_list" type="radio" name="plugin[qq_open]" value="' . $k . '"' . $selectstr . '> ' . $v . '</label>';
                        }
                        ?>
                    </div>
                </div>
                <div class="form-group qq_list" style="<?= isset($data['plugin']['qq_open']) && $data['plugin']['qq_open'] == 1 ? '' : 'display:none' ?>">
                    <label class="col-lg-2 control-label">在线客服QQ</label>
                    <div class="col-lg-10">
                        <input class="form-control" type="text" name="plugin[qq_list]" maxlength="255" value="<?= isset($data['plugin']['qq_list']) ? $data['plugin']['qq_list'] : ''; ?>">
                        <span class="help-block">示例：蔓荆子|19744244,素食派|42344344  如果多个QQ用英文逗号隔开</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">音乐播放开关</label>
                    <div class="col-lg-10">
                        <?php
                        foreach (Config::getStatusOpenCloseText() as $k => $v) {
                            $selectstr = isset($data['plugin']['player_open']) && $data['plugin']['player_open'] == $k ? ' checked="checked"' : '';
                            echo '<label class="radio-inline"><input data-rule="checked" class="showhide" data-show="1|player_url" data-hide="2|player_url" type="radio" name="plugin[player_open]" value="' . $k . '"' . $selectstr . '> ' . $v . '</label>';
                        }
                        ?>
                    </div>
                </div>
                <div class="form-group player_url" style="<?= isset($data['plugin']['player_open']) && $data['plugin']['player_open'] == 1 ? '' : 'display:none' ?>">
                    <label class="col-lg-2 control-label">音乐地址</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" rows="3" name="plugin[player_url]"><?= isset($data['plugin']['player_url']) ? $data['plugin']['player_url'] : '' ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">特别公告开关</label>
                    <div class="col-lg-10">
                        <?php
                        foreach (Config::getStatusOpenCloseText() as $k => $v) {
                            $selectstr = isset($data['plugin']['notice_open']) && $data['plugin']['notice_open'] == $k ? ' checked="checked"' : '';
                            echo '<label class="radio-inline"><input data-rule="checked" class="showhide" data-show="1|notice_open" data-hide="2|notice_open" type="radio" name="plugin[notice_open]" value="' . $k . '"' . $selectstr . '> ' . $v . '</label>';
                        }
                        ?>
                    </div>
                </div>
                <div class="form-group notice_open" style="<?= isset($data['plugin']['notice_open']) && $data['plugin']['notice_open'] == 1 ? '' : 'display:none' ?>">
                    <label class="col-lg-2 control-label">特别公告</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" rows="3" name="plugin[notice_message]"><?= isset($data['plugin']['notice_message']) ? $data['plugin']['notice_message'] : ''; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="tab7">
                <div class="form-group">
                    <label class="col-lg-2 control-label">手机注册开关</label>
                    <div class="col-lg-4">
                        <?php
                        foreach (Config::getStatusOpenCloseText() as $k => $v) {
                            $selectstr = isset($data['system']['mobile_register_status']) && $data['system']['mobile_register_status'] == $k ? ' checked="checked"' : '';
                            echo '<label class="radio-inline"><input data-rule="checked" type="radio" name="system[mobile_register_status]" value="' . $k . '"' . $selectstr . '> ' . $v . '</label>';
                        }
                        ?>
                    </div>
                    <label class="col-lg-2 control-label">邮箱注册开关</label>
                    <div class="col-lg-4">
                        <?php
                        foreach (Config::getStatusOpenCloseText() as $k => $v) {
                            $selectstr = isset($data['system']['email_register_status']) && $data['system']['email_register_status'] == $k ? ' checked="checked"' : '';
                            echo '<label class="radio-inline"><input data-rule="checked" type="radio" name="system[email_register_status]" value="' . $k . '"' . $selectstr . '> ' . $v . '</label>';
                        }
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">前台访问开关</label>
                    <div class="col-lg-4">
                        <?php
                        foreach (Config::getStatusOpenCloseText() as $k => $v) {
                            $selectstr = isset($data['system']['system_site_open']) && $data['system']['system_site_open'] == $k ? ' checked="checked"' : '';
                            echo '<label class="radio-inline"><input data-rule="checked" class="showhide" data-show="2|close_msg" data-hide="1|close_msg" type="radio" name="system[system_site_open]" value="' . $k . '"' . $selectstr . '> ' . $v . '</label>';
                        }
                        ?>
                    </div>
                    <label class="col-lg-2 control-label">前台用户登录开关</label>
                    <div class="col-lg-4">
                        <?php
                        foreach (Config::getStatusOpenCloseText() as $k => $v) {
                            $selectstr = isset($data['system']['user_login_status']) && $data['system']['user_login_status'] == $k ? ' checked="checked"' : '';
                            echo '<label class="radio-inline"><input data-rule="checked" type="radio" name="system[user_login_status]" value="' . $k . '"' . $selectstr . '> ' . $v . '</label>';
                        }
                        ?>
                    </div>
                </div>
                <div class="form-group close_msg" style="<?= isset($data['system']['system_site_open']) && $data['system']['system_site_open'] == 1 ? 'display:none' : '' ?>">
                    <label class="col-lg-2 control-label">前台关闭访问通知</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" rows="3" name="system[system_site_close_msg]"><?= isset($data['system']['system_site_close_msg']) ? $data['system']['system_site_close_msg'] : ''; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">操作日志开关</label>
                    <div class="col-lg-4">
                        <?php
                        foreach (Config::getStatusOpenCloseText() as $k => $v) {
                            $selectstr = isset($data['system']['user_log_status']) && $data['system']['user_log_status'] == $k ? ' checked="checked"' : '';
                            echo '<label class="radio-inline"><input data-rule="checked" type="radio" name="system[user_log_status]" value="' . $k . '"' . $selectstr . '> ' . $v . '</label>';
                        }
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">前台模板</label>
                    <div class="col-lg-4">
                        <?php
                        foreach ($dir_array as $v) {
                            $selectstr = isset($data['system']['system_template']) && $data['system']['system_template'] == $v ? ' checked="checked"' : '';
                            echo '<label class="radio-inline"><input data-rule="checked" type="radio" name="system[system_template]" value="' . $v . '"' . $selectstr . '> ' . $v . '</label>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">保存</button>
            </div>
        </div>
    </div>
</form>