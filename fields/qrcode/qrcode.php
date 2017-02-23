<?php
class QrcodeField extends BaseField {

  static public $fieldname = 'qrcode';
  static public $assets = array(
    //'css' => array(
    //  'style.css',
    //)
  );

  public function input() {
    $html = tpl::load( __DIR__ . DS . 'template.php', $data = array(
      'page' => $this->page,
      'fieldname' => self::$fieldname,
    ));
    return $html;
  }
}
