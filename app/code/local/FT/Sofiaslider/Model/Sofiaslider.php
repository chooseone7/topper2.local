<?php

class FT_Sofiaslider_Model_Sofiaslider extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('sofiaslider/sofiaslider');
    }

}