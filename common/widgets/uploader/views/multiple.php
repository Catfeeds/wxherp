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
        $array = explode(',', $value);
        foreach ($array as $v) {
            $id = md5($v);
            echo '<div id="item-' . $id . '" class="item"><a data-id="' . $id . '" data-name="' . $name . '" data-path="' . $v . '" class="file-delete">×</a><img src="' . Upload::getThumb($v) . '"></div>';
        }
    }
    ?>
    <a class="btn-select" id="btn-select-<?= $name ?>"><span>+</span></a> 
</div>
<?php
$param = json_encode(['name' => $name, 'extensions' => $extensions, 'more' => $more, 'isFile' => $is_file, 'objectId' => $object_id, 'uploadUrl' => $upload_url, 'deleteUrl' => $delete_url, 'baseUrl' => $bundle->baseUrl]);
$js = <<<EOT
    window.$name = $param;
    multipleUpload($param);
EOT;
common\assets\BackendAsset::addScript($js);
