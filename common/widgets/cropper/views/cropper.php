<button type="button" class="btn btn-primary" data-target="#preview-modal" data-toggle="modal">
    更换头像
</button>
<div class="modal fade" id="preview-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">更换头像</h4>
            </div>
            <div class="modal-body">
                <label class="btn btn-default"><input type="file" id="preview-file" class="hide">点击选择本地图像文件...</label>
                <div class="row">
                    <div class="col-md-9">
                        <div class="preview-wrapper"><img id="preview-image"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="preview preview-lg"></div>
                        <div class="preview preview-md"></div>
                        <div class="preview preview-sm"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" id="btn-preview" class="btn btn-primary">保存</button>
            </div>
            <div id="roundedCanvas"></div>
        </div>
    </div>
</div>
<script>
    // 绘制矩形canvas
    function getRoundedCanvas(sourceCanvas) {
        var canvas = document.createElement('canvas');
        var context = canvas.getContext('2d');
        var width = sourceCanvas.width;
        var height = sourceCanvas.height;

        canvas.width = width;
        canvas.height = height;

        context.imageSmoothingEnabled = true;
        context.drawImage(sourceCanvas, 0, 0, width, height);
        context.globalCompositeOperation = 'destination-in';
        context.beginPath();
        context.rect(0, 0, width, height);
        context.fill();

        return canvas;
    }

    $(function () {
        var croppable = false;
        var $image = $('#preview-image');
        var $previews = $('.preview');

        var initCropper = function () {
            $image.cropper({
                aspectRatio: 1,
                ready: function (e) {
                    var $clone = $(this).clone().removeClass('cropper-hidden');
                    $previews.html($clone);
                    croppable = true;
                },
                crop: function (e) {
                    var imageData = $(this).cropper('getImageData');
                    var previewAspectRatio = e.width / e.height;
                    // 多个预览裁剪
                    $previews.each(function () {
                        var $preview = $(this);
                        var previewWidth = $preview.width();
                        var previewHeight = previewWidth / previewAspectRatio;
                        var imageScaledRatio = e.width / previewWidth;

                        $preview.height(previewHeight).find('img').css({
                            width: imageData.naturalWidth / imageScaledRatio,
                            height: imageData.naturalHeight / imageScaledRatio,
                            marginLeft: -e.x / imageScaledRatio,
                            marginTop: -e.y / imageScaledRatio
                        });
                    });
                }
            });
        };

        //保存裁剪图像
        $('#preview-file').on('change', function () {
            var fr = new FileReader();
            var file = this.files[0];
            if (!/image\/\w+/.test(file.type)) {
                showError(file.name + '不是图片文件');
                return false;
            } else if (file.size > 2 * 1024 * 1024) {
                showError('图片大小不能超过2M');
                return false;
            }

            fr.readAsDataURL(file);
            fr.onload = function () {
                $image.attr('src', fr.result);
                initCropper(); // 初始化cropper
            };
        });

        $('#btn-preview').on('click', function () {
            if (croppable) {
                var croppedCanvas = $image.cropper('getCroppedCanvas');
                var roundedCanvas = getRoundedCanvas(croppedCanvas);
                var base64data = roundedCanvas.toDataURL();
                var json = getCsrf();
                json.data = base64data.replace('data:image/png;base64,', '');
                layer.msg('保存中...', {icon: 16, shade: 0.01, time: 0});

                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: '<?= $upload_url ?>',
                    data: json,
                    success: function (data, statusText) {
                        if (statusText === 'success') {
                            if (data.status === 1) {
                                window.location.reload();
                            } else {
                                showError('no');
                            }
                        } else {
                            showError('Server error');
                        }
                    },
                    error: function () {
                        showError('Server error');
                    }
                });
            }
        });
    });
</script>