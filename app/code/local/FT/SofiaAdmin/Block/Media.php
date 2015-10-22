<?php

class FT_SofiaAdmin_Block_Media extends Mage_Catalog_Block_Product_View_Media
{

    protected function _beforeToHtml()
    {
        if (Mage::getStoreConfig('sofiaadmin/cloudzoom/enabled'))
            $this->setTemplate('catalog/product/view/czoom_media.phtml');

        return $this;
    }
}