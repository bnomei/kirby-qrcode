<?php

require_once __DIR__ . '/vendor/autoload.php';

class KirbyQRCode {
  public static function qrcode($page, $options = null) {
    
      $defaults = c::get('plugin.qrcode', array());
      if(!$options) $options = array();
      $settings = a::merge($defaults, $options);

      if(!a::get($settings, 'Text')) 
        $settings['Text'] = $page->url();

      if(!a::get($settings, 'Filename')) 
        $settings['Filename'] = $page->slug().'-qrcode';

      $qrCode = new Endroid\QrCode\QrCode();

      foreach ($settings as $setter => $value) {
        $methodVariable = array($qrCode, 'set'.$setter);
        if(is_callable($methodVariable)) {
          $qrCode->{$methodVariable[1]}($value);
        }
      }

      $path = kirby()->roots()->thumbs();
      $url  = kirby()->urls()->thumbs();
      $file = DS.$page->uri().DS.$settings['Filename'].'.'.$qrCode->getImageType();

      $qrCode->save($path.$file);

      return new Media($path.$file, $url.$file);
    }
}

$kirby->set('page::method', 'qrcode', 
  function($page, $options = null) {
    return KirbyQRCode::qrcode($page, $options);
});

$kirby->set('blueprint', 'fields/qrcode', __DIR__ . '/fields/qrcode/qrcode.yml');

$kirby->set('field', 'qrcode', __DIR__ . '/fields/qrcode');
