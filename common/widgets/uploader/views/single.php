<?php

use common\models\Upload;
use common\widgets\uploader\UploaderAsset;

$bundle = UploaderAsset::register($this);
?>
<input name="old_<?= $name ?>" type="hidden" value="<?= $value; ?>">
<input id="upload-list-<?= $name ?>" name="<?= $name ?>" type="hidden" value="<?= $value; ?>">

<div id="div-container-<?= $name ?>" class="div-list"> 
    <?php
    if ($value) {
        $id = md5($value);
        echo '<div id="item-' . $id . '" class="item"><a data-id="' . $id . '" data-name="' . $name . '" data-path="' . $value . '" class="file-delete">×</a><img src="' . Upload::getThumb($value) . '"></div>';
    }
    ?>
    <a class="btn-select" id="btn-select-<?= $name ?>" style="<?= $value ? 'display:none' : '' ?>"><span>+</span></a> 
</div>
<?php
$param = json_encode(['name' => $name, 'extensions' => $extensions, 'more' => $more, 'isFile' => $is_file, 'objectId' => $object_id, 'objectType' => $object_type, 'uploadUrl' => $upload_url, 'deleteUrl' => $delete_url, 'baseUrl' => $bundle->baseUrl]);
$js = <<<EOT
    window.$name = $param;
    singleUpload($param);
EOT;
common\assets\BackendAsset::addScript($js);
