<?php

class FT_SofiaAdmin_Block_Adminhtml_Activate_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_blockGroup = 'sofiaadmin';
        $this->_controller = 'adminhtml_activate';
        $this->_updateButton('save', 'label', Mage::helper('sofiaadmin')->__('Activate Sofia Theme'));
        $this->_removeButton('delete');
        $this->_removeButton('back');
    }

    public function getHeaderText()
    {
        return Mage::helper('sofiaadmin')->__('Activate Sofia Theme');
    }
}
