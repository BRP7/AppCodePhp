<?php
class Cart_Controller_Checkout extends Core_Controller_Front_Action{

    public function CheckoutAction() {
        $customerId = Mage::getSingleton("core/session")->get("logged_in_customer_id");
        if(!$customerId){
            $this->checkDataAndRedirect(['customer/account/login'=>$customerId]);
        }else{
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