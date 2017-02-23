<?php
// tpl(, $data) => $page, $fieldname

// using lib defaults or config.php settings
$qrcode = $page->qrcode()->html(); // media object to brick

$div = brick('div')
	->addClass('plugin-'.$fieldname)
	->append($qrcode);

echo $div;

?>