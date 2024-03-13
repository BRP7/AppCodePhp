<?php
class Cart_Controller_index extends Core_Controller_Front_Action{
    
    public function cartAction() {
        $this->setFormCss("addToCart");
        $layout = $this->getLayout();
        $child = $layout->getChild("content");
        $brand = $layout->createBlock("cart/cart")->setTemplate("customer/addToCart.phtml");
        $child->addChild('form',$brand);
        $layout->toHtml();
        
    }
    public function checkoutAction() {
      
        if($cutomerId){
            $this->setFormCss("checkout");
            $layout = $this->getLayout();
            $child = $layout->getChild("content");
            $brand = $layout->createBlock("cart/checkout")->setTemplate("customer/checkout.phtml");
            $child->addChild('form',$brand);
            $layout->toHtml();
        }
     
        
    }
}
?>