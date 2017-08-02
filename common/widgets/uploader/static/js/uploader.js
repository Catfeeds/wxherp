/* global layer, plupload */

function multipleUpload(param) {
    var data = getCsrf();
    data.object_id = param.objectId;
    data.object_type = param.objectType;
    var config = {
        runtimes: 'html5,flash,silverlight,html4',
        browse_button: 'btn-select-' + param.name,
        container: 'div-container-' + param.name,
        file_data_name: param.isFile ? 'UploadForm[file]' : 'UploadForm[picture]',
        flash_swf_url: param.baseUrl + '/js/Moxie.swf',
        silverlight_xap_url: param.baseUrl + '/js/Moxie.xap',
        max_file_size: '2mb', //限制为2MB
        url: param.uploadUrl,
        multipart_params: data,
        multi_selection: true, //是否可以在文件浏览对话框中选择多个文件
        filters: [{title: '选择文件', extensions: param.extensions}]//文件限制
    };

    var uploader = new plupload.Uploader(config);
    uploader.init();
    uploader.bind('BeforeUpload', function (uploader, file) {

    });
    //选择文件完毕触发
    uploader.bind('FilesAdded', function (uploader, files) {
        var item = '';
        plupload.each(files, function (file) {
            item += '<div id="item-' + file.id + '" class="item"><div class="progress"><div id="bar-' + file.id + '" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;"></div></div></div>';
        });
        $('#div-container-' + param.name).prepend(item);
        uploader.start();
    });

    //图片上传成功触发
    uploader.bind('FileUploaded', function (uploader, file, data) {
        var res = $.parseJSON(data.response);
        if (res.error === 0) {
            var upload_list = $('#upload-list-' + param.name).val();//获取文件路径
            var array = new Array();//为空就新建数组对象
            if (upload_list) {//如果有值就格式化为数组
                array = upload_list.split(',');
            }
            array.push(res.fileurl);//把上传成功后的图片路径加入数组
            $('#upload-list-' + param.name).val(array.join());
            $('#item-' + file.id).html('<a data-id="' + file.id + '" data-name="' + param.name + '" data-path="' + res.fileurl + '" class="file-delete">×</a><img src="' + res.thumb + '">');
        } else {
            showError(res.message);
        }
    });
    //会在文件上传过程中不断触发，可以用此事件来显示上传进度监听（比如说上传进度）
    uploader.bind('UploadProgress', function (uploader, file) {
        $('#bar-' + file.id).attr('aria-valuenow', file.percent);
        $('#bar-' + file.id).css('width', file.percent + '%');
    });
    //文件上传成功后
    uploader.bind('UploadComplete', function (uploader, files) {

    });
    uploader.bind('Error', function (uploader, error) {
        var message = {
            '-100': '发生错误',
            '-200': 'http网络错误',
            '-300': '磁盘读写错误',
            '-400': '安全问题产生错误',
            '-500': '初始化时产生错误',
            '-600': '文件太大',
            '-601': '文件类型不符合要求',
            '-602': '选取了重复的文件',
            '-700': '图片格式错误',
            '-701': '内存错误',
            '-702': '文件太大'
        };
        showError('错误提示：' + message[error.code]);
    });
}

function singleUpload(param) {
    var data = getCsrf();
    data.object_id = param.objectId;
    data.object_type = param.objectType;
    var config = {
        runtimes: 'html5,flash,silverlight,html4',
        browse_button: 'btn-select-' + param.name,
        container: 'div-container-' + param.name,
        file_data_name: param.isFile ? 'UploadForm[file]' : 'UploadForm[picture]',
        flash_swf_url: param.baseUrl + '/js/Moxie.swf',
        silverlight_xap_url: param.baseUrl + '/js/Moxie.xap',
        max_file_size: '2mb', //限制为2MB
        url: param.uploadUrl,
        multipart_params: data,
        multi_selection: false, //是否可以在文件浏览对话框中选择多个文件
        filters: [{title: '选择文件', extensions: param.extensions}]//文件限制
    };

    var uploader = new plupload.Uploader(config);
    uploader.init();
    uploader.bind('BeforeUpload', function (uploader, file) {

    });
    //选择文件完毕触发
    uploader.bind('FilesAdded', function (uploader, files) {
        var item = '';
        plupload.each(files, function (file) {
            item += '<div id="item-' + file.id + '" class="item"><div class="progress"><div id="bar-' + file.id + '" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;"></div></div></div>';
        });
        $('#btn-select-' + param.name).hide();
        $('#div-container-' + param.name).append(item);
        uploader.start();
    });

    //图片上传成功触发
    uploader.bind('FileUploaded', function (uploader, file, data) {
        var res = $.parseJSON(data.response);
        if (res.error === 0) {
            $('#upload-list-' + param.name).val(res.fileurl);
            $('#item-' + file.id).html('<a data-id="' + file.id + '" data-name="' + param.name + '" data-path="' + res.fileurl + '" class="file-delete">×</a><img src="' + res.thumb + '">');
        } else {
            $('#btn-select-' + param.name).show();
            showError(res.message);
        }
    });
    //会在文件上传过程中不断触发，可以用此事件来显示上传进度监听（比如说上传进度）
    uploader.bind('UploadProgress', function (uploader, file) {
        $('#bar-' + file.id).attr('aria-valuenow', file.percent);
        $('#bar-' + file.id).css('width', file.percent + '%');
    });
    //文件上传成功后
    uploader.bind('UploadComplete', function (uploader, files) {

    });
    uploader.bind('Error', function (uploader, error) {
        var message = {
            '-100': '发生错误',
            '-200': 'http网络错误',
            '-300': '磁盘读写错误',
            '-400': '安全问题产生错误',
            '-500': '初始化时产生错误',
            '-600': '文件太大',
            '-601': '文件类型不符合要求',
            '-602': '选取了重复的文件',
            '-700': '图片格式错误',
            '-701': '内存错误',
            '-702': '文件太大'
        };
        showError('错误提示：' + message[error.code]);
    });
}
//删除图片
$(function () {
    $('body').on('click', '.file-delete', function () {
        var id = $(this).attr('data-id');
        var path = $(this).attr('data-path');
        var name = $(this).attr('data-name');
        var param = window[name];
        var data = getCsrf();
        data.object_id = param.objectId;
        data.path = path;
        layer.msg('确定要删除吗？', {
            time: 0, //不自动关闭
            btn: ['确定', '关闭'],
            btnAlign: 'c',
            yes: function (index) {
                layer.close(index);
                layer.msg('加载中...', {icon: 16, shade: 0.01, time: 0});
                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: param.deleteUrl,
                    data: data,
                    success: function (result) {
                        if (result.status === 0) {
                            if (param.more) {
                                var upload_list = $('#upload-list-' + name).val();//获取文件路径
                                var array = upload_list.split(',');//为空就新建数组对象
                                $.each(array, function (i, n) {
                                    if (path === n) {
                                        array.splice(i, 1);//从已上传的文件路径中移除
                                    }
                                });
                                $('#upload-list-' + name).val(array.join());
                            } else {
                                $('#upload-list-' + name).val('');
                            }
                            $('#item-' + id).remove();
                        } else {
                            showError('错误提示：' + result.msg);
                        }
                        $('#btn-select-' + name).show();
                        layer.closeAll();
                    }, error: function (xhr) {
                        showError('错误提示：' + xhr.statusText);
                        $('#btn-select-' + name).show();
                        layer.closeAll();
                    }
                });
                return false;
            },
            btn2: function () { }
        });
    });
});