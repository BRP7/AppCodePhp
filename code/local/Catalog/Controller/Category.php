<?php 
class Catalog_Controller_Category extends Core_Controller_Front_Action {

    // protected   $_addToCart = [];
    public function viewAction()
    {
        print_r($this->setFormCss("views"));
        $layout = $this->getLayout();
        $child = $layout->getchild('content'); //core_block_layout
        $productForm = $layout->createBlock('catalog/admin_category_list');
        $child->addChild('list',$productForm);
        $layout->toHtml();
    }

    
}
?>