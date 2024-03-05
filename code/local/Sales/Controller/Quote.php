<?php
class Sales_Controller_Quote extends Core_Controller_Front_Action{

    

    public function addAction() {
        $data =  $this->getRequest()->getParams('cart');
        $data = $data + ['item_id'=>20];
        // print_r($data);
        $quote = Mage::getModel('sales/quote')->addProduct($data);
       
}

      //$customerId = Mage::getSingleton("core/session")->get("logged_in_customer_id");
    
      // Check if a customer is logged in
    //   if ($customerId) {
    //       // Retrieve cart data from persistent storage
    //       $cartData = $this->getCartData();
          
    //       // Get the product ID from the request
    //       $productId = $this->getRequest()->getQueryData('id');
          
    //       // Check if the product ID is valid and exists in the cart
    //       if (!empty($productId) && isset($cartData[$customerId][$productId])) {
    //           // Display product information for the specified product
    //           $product = $cartData[$customerId][$productId];
    //           echo '<h2>Product Details</h2>';
    //           echo 'Product ID: ' . $productId . '<br>';
    //           echo 'Quantity: ' . $product['quantity'] . '<br>';
    //           // You can display other product details here as needed
    //       } else {
    //           echo '<h2>Product Not Found in Cart</h2>';
    //       }
    //   } else {
    //      $this->setRedirect("customer/account/login");
    //   }
  
    public function editAction() {
        $this->linkActionProceed();
    }
    public function removeAction(){
        $this->removeActionProceed(); 
    }
    
    public function postdataAction() {  
        $this->postdataActionProceed();
     }
    public function deleteAction() {
     $request = ['item_id'=> 20];
     $quote = Mage::getSingleton('sales/quote')->removeProduct($request);   
    }

}