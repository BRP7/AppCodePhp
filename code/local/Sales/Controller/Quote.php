<?php
class Sales_Controller_Quote extends Core_Controller_Front_Action{

    

    public function addAction() {
        $data =  $this->getRequest()->getParams('cart');
        $quote = Mage::getModel('sales/quote')->addProduct($data);
    }
    // public function CheckoutAction() {
    //     $customerId = Mage::getSingleton("core/session")->get("logged_in_customer_id");
    //     $this->checkDataAndRedirect(['customer/account/login'=>$customerId]);
    //          $request = ['quote_id' => $this->getRequest()->getParams('qid'),
    //                         'item_id' => $this->getRequest()->getParams('id'),
    //                         'product_id' => $this->getRequest()->getParams('pid')];
    //          $quote = Mage::getSingleton('sales/quote')->checkProduct($request);   

        
    //     }
  
    public function deleteAction() {
    //  $request =  $this->getRequest()->getQueryData('id');
     $request = ['quote_id' => $this->getRequest()->getParams('qid'),
                    'item_id' => $this->getRequest()->getParams('id')];
     $quote = Mage::getSingleton('sales/quote')->removeProduct($request);   
    }

}