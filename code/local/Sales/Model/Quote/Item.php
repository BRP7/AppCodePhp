<?php

class Sales_Model_Quote_Item extends Core_Model_Abstract
{

    public function init()
    {
        $this->_resourceClass = 'Sales_Model_Resource_Quote_Item';
        $this->_collectionClass = 'Sales_Model_Resource_Collection_Quote_Item';
        $this->_modelClass = 'sales/quote_item';
    }

    public function getProduct()
    {
        return Mage::getModel('catalog/product')->load($this->getProductId());
    }

    protected function _beforeSave()
    {
        if ($this->getProductId()) {
            $price = $this->getProduct()->getPrice();
            $this->addData('price', $price);
            $this->addData('row_total', $price * $this->getQty());
        } else {
        }
    }

    public function addItem(Sales_Model_Quote $quote, $productId, $qty)
    {
        $item = $this->getCollection()
            ->addFieldToFilter('product_id', $productId)
            ->addFieldToFilter('quote_id', $quote->getId())
            ->getFirstItem()
        ;

       $existingItem = $this->getCollection()
            ->addFieldToFilter('quote_id', $quote->getId())
            ->addFieldToFilter('product_id', $productId)
            ->getFirstItem();

        if($existingItem && $existingItem->getId() !== ''){
            $existingQty = $existingItem->getQty();
            $existingItem->addData('qty', $existingQty + $qty);
            $existingItem->save();
        }else{
            $this->setData([
                'quote_id' => $quote->getId(),
                'product_id' => $productId,
                'qty' => $qty
            ]);
            $this->save();
        }
    }
}