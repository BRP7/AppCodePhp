<?php

class Sales_Model_Quote extends Core_Model_Abstract
{
    public function init()
    {
        $this->_resourceClass = 'Sales_Model_Resource_Quote';
        $this->_collectionClass = 'Sales_Model_Resource_Collection_Quote';
        // $this->_modelClass = 'sales/quote';
    }

    public function initQuote()
    {
        $quoteId = Mage::getSingleton("core/session")->get("quote_id");
        // var_dump($quoteId);
        if (!empty($quoteId)) {
           $this->load($quoteId);//sales_quote
        }
        if (!$this->getId()) {
            $quote = Mage::getModel("sales/quote")
                ->setData(["tax_percent" => 8, "grand_total" => 0])
                ->save();
            Mage::getSingleton("core/session")->set("quote_id", $quote->getId());
            $quoteId = $quote->getId();
            $this->load($quoteId);
        }
        return $this;

    }

    public function getItemCollection()
    {
        // var_dump($this->getId());
        return Mage::getModel('sales/quote_item')->getCollection()
            ->addFieldToFilter('quote_id', $this->getId());
    }

    protected function _beforeSave()
    {
        $grandTotal = 0;
        foreach ($this->getItemCollection()->getData() as $_item) {
            $grandTotal += $_item->getRowTotal();
        }
        if ($this->getTaxPercent()) {
            $tax = round($grandTotal / $this->getTaxPercent(), 2);
            $grandTotal = $grandTotal + $tax;
        }
        $this->addData('grand_total', $grandTotal);
    }

    public function addProduct($request)
    {
        $this->initQuote();
        if ($this->getId()) {
            Mage::getSingleton('sales/quote_item')
                ->addItem($this, $request);//product_id,qty for add
        }
        $this->save();
        return $this;
    }

    public function removeProduct($request)
    {
        // $quoteId = Mage::getSingleton("core/session")->get("quote_id");
        $quoteId = $request['quote_id'];
        //  print_r($quoteId);  
        $this->initQuote();
        if ($quoteId) {
            Mage::getSingleton('sales/quote_item')
                ->removeItem($quoteId, $request['item_id']);
        }

        $this->save();
        return $this;
    }
    public function checkProduct($request)
    {
        $customerId = Mage::getSingleton("core/session")->get("logged_in_customer_id");
        if ($customerId) {
            print_r($customerId);
            $this->initQuote();
            // $quoteId = Mage::getSingleton("core/session")->get("quote_id");
            // $quoteId = $request['quote_id'];
            Mage::getSingleton('sales/quote_customer')
                ->checkoutItem($request);
        }else{
            // $user="customer/account/login";
            // $url=Mage::getBaseUrl() .$user;
            $this->setRedirect('customer/account/login');
            // header('Location:'."http://localhost/practice/MVC/customer/account/login");
        }

        $this->save();
        return $this;
    }


    
}

