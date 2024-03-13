<?php

class Core_Controller_Front_Action
{
  protected $_layout = null;
  public function __construct()
  {
    $this->init();
    $layout = $this->getLayout();
    $layout->getChild("head")
      ->addCss("header.css")
      ->addCss("footer.css");
  }
  public function init(){
    return $this;
  }


  public function getLayout()
  {
    if (is_null($this->_layout)) { 
      $this->_layout = Mage::getBlock("core/layout");
      return $this->_layout;
    }
    return $this->_layout;
  }

  public function getRequest()
  {
    return Mage::getModel("core/request");
  }



public function setFormCss($file)
{
    $layout = $this->getLayout();
    $layout->getChild('head')
        ->addCss($file.'.css');
}

public function setRedirect($url){
  $url=Mage::getBaseUrl() . $url;
  header('Location:'.$url);
}

// public function checkDataAndRedirect(array $data, $redirect){
//   foreach($data as $_data){
//       if(!$_data){
//           $this->setRedirect($redirect);
//       }   
//   }
// }

public function checkDataAndRedirect(array $data)
{
  foreach ($data as $_keys => $_values) {
    if (!$_values) {
      $this->setRedirect($_keys);
      break;
    }
  }
} 


}

?>