<?php

class FT_Sofiaslider_Block_Adminhtml_Sofiaslider extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_controller = 'adminhtml_sofiaslider';
		$this->_blockGroup = 'sofiaslider';
		$this->_headerText = Mage::helper('sofiaslider')->__('Slides Manager');
		$this->_addButtonLabel = Mage::helper('sofiaslider')->__('Add Slide');
		parent::__construct();
	}
}