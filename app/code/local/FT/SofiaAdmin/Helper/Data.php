<?php

class FT_SofiaAdmin_Helper_Data extends Mage_Core_Helper_Abstract
{

    protected function _loadProduct(Mage_Catalog_Model_Product $product)
    {
        $product->load($product->getId());
    }

    public function getLabel(Mage_Catalog_Model_Product $product)
    {
        $html = '';
        if (!Mage::getStoreConfig("sofiaadmin/productdetail/new_label") &&
            !Mage::getStoreConfig("sofiaadmin/productdetail/sale_label") ) {
            return $html;
        }

        $this->_loadProduct($product);

        if ( Mage::getStoreConfig("sofiaadmin/productdetail/new_label") && $this->_isNew($product) ) {
            $htmlN = '<div class="new-label product-label">'.$this->__('New').'</div>';
            $html.= $htmlN;
        }
        if ( Mage::getStoreConfig("sofiaadmin/productdetail/sale_label") && $this->_isOnSale($product) ) {
            $htmlS .= '<div class="sale-label product-label">'.$this->__('Sale').'</div>';
            $html.= $htmlS;
        }

        return $html;
    }

    protected function _checkDate($from, $to)
    {
        $date = new Zend_Date();
        $today = strtotime($date->__toString());

        if ($from && $today < $from) {
            return false;
        }
        if ($to && $today > $to) {
            return false;
        }
        if (!$to && !$from) {
            return false;
        }
        return true;
    }

    protected function _isNew($product)
    {
        $from = strtotime($product->getData('news_from_date'));
        $to = strtotime($product->getData('news_to_date'));

        return $this->_checkDate($from, $to);
    }

    protected function _isOnSale($product)
    {
        $from = strtotime($product->getData('special_from_date'));
        $to = strtotime($product->getData('special_to_date'));

        return $this->_checkDate($from, $to);
    }

    public function priceFormat($string)
    {
        $currency = Mage::app()->getLocale()->currency(Mage::app()->getStore()->getCurrentCurrencyCode())->getSymbol();
        return str_replace($currency, '<sup>'.$currency.'</sup>', $string);
    }
}