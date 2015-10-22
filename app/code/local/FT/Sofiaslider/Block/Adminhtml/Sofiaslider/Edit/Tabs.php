<?php

class FT_Sofiaslider_Block_Adminhtml_Sofiaslider_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('sofiaslider_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('sofiaslider')->__('Slide Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('sofiaslider')->__('Slide Information'),
          'title'     => Mage::helper('sofiaslider')->__('Slide Information'),
          'content'   => $this->getLayout()->createBlock('sofiaslider/adminhtml_sofiaslider_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}