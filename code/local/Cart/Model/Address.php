<?php

class Cart_Model_Address extends Core_Model_Abstract{
    public function init(){
        $this->_resourceClass = 'Cart_Model_Resource_Address';
        $this->_collectionClass = 'Cart_Model_Resource_Collection_Address';
    }
}
?>