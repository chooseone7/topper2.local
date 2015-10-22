<?php

class FT_SofiaAdmin_Model_Config_Upsell
{
    public function toOptionArray()
    {
        return array(
            array(
                'value'=>'never',
                'label' => Mage::helper('sofiaadmin')->__('Never Replace Upsell Products')),
            array(
                'value'=>'always',
                'label' => Mage::helper('sofiaadmin')->__('Always Replace Upsell Products')),
            array(
                'value'=>'only',
                'label' => Mage::helper('sofiaadmin')->__('Replace Only if No Upsell Products')),
        );
    }
}