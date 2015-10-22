<?php

class FT_SofiaAdmin_Model_Config_Numbercols
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'2', 'label'=>Mage::helper('sofiaadmin')->__('2')),
            array('value'=>'3', 'label'=>Mage::helper('sofiaadmin')->__('3')),
			array('value'=>'4', 'label'=>Mage::helper('sofiaadmin')->__('4')),
            array('value'=>'5', 'label'=>Mage::helper('sofiaadmin')->__('5')),
            array('value'=>'6', 'label'=>Mage::helper('sofiaadmin')->__('6')),
            array('value'=>'7', 'label'=>Mage::helper('sofiaadmin')->__('7')) 
        );
    }
}