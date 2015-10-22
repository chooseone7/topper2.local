<?php

class FT_Sofiaslider_Block_Adminhtml_Sofiaslider_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'sofiaslider';
        $this->_controller = 'adminhtml_sofiaslider';
        
        $this->_updateButton('save', 'label', Mage::helper('sofiaslider')->__('Save Slide'));
        $this->_updateButton('delete', 'label', Mage::helper('sofiaslider')->__('Delete Slide'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('sofiaslider_data') && Mage::registry('sofiaslider_data')->getId() ) {
            return Mage::helper('sofiaslider')->__("Edit Slide '%s'", $this->escapeHtml(Mage::registry('sofiaslider_data')->getTitle()));
        } else {
            return Mage::helper('sofiaslider')->__('Add Slide');
        }
    }
}