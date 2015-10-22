<?php

class FT_Sofiaslider_Block_Adminhtml_Sofiaslider_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {

	  $model = Mage::registry('sofiaslider_sofiaslider');

      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('sofiaslider_form', array('legend'=>Mage::helper('sofiaslider')->__('Slide information')));

	  if (!Mage::app()->isSingleStoreMode()) {
        $fieldset->addField('store_id', 'multiselect', array(
              'name'      => 'stores[]',
              'label'     => Mage::helper('sofiaslider')->__('Store View'),
              'title'     => Mage::helper('sofiaslider')->__('Store View'),
              'required'  => true,
              'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
          ));
      }
      else {
          $fieldset->addField('store_id', 'hidden', array(
              'name'      => 'stores[]',
              'value'     => Mage::app()->getStore(true)->getId()
          ));
      }

      $fieldset->addField('slide_align', 'select', array(
          'label'     => Mage::helper('sofiaslider')->__('Text Align'),
          'name'      => 'slide_align',
          'values'    => array(
              array(
                  'value'     => 'left',
                  'label'     => Mage::helper('sofiaslider')->__('Left'),
              ),
              array(
                  'value'     => 'right',
                  'label'     => Mage::helper('sofiaslider')->__('Right'),
              ),
              array(
                  'value'     => 'center',
                  'label'     => Mage::helper('sofiaslider')->__('Center'),
              ),
          ),
      ));

      $fieldset->addField('slide_title', 'text', array(
          'label'     => Mage::helper('sofiaslider')->__('Title'),
          'required'  => false,
          'name'      => 'slide_title',
      ));
      
      $fieldset->addField('slide_title_color', 'text', array(
                              'label'     => Mage::helper('sofiaslider')->__('Color Title'),
                              'required'  => false,
                              'name'      => 'slide_title_color',
      ));
      
      $fieldset->addField('slide_sub_title', 'text', array(
                              'label'     => Mage::helper('sofiaslider')->__('Sub Title'),
                              'required'  => false,
                              'name'      => 'slide_sub_title',
      ));
      
      $fieldset->addField('slide_sub_title_color', 'text', array(
                              'label'     => Mage::helper('sofiaslider')->__('Color Sub Title'),
                              'required'  => false,
                              'name'      => 'slide_sub_title_color',
      ));
      
      $fieldset->addField('slide_text', 'textarea', array(
          'label'     => Mage::helper('sofiaslider')->__('Text'),
          'required'  => false,
          'name'      => 'slide_text',
      ));
      $fieldset->addField('slide_text_color', 'text', array(
                              'label'     => Mage::helper('sofiaslider')->__('Color Text'),
                              'required'  => false,
                              'name'      => 'slide_text_color',
      ));
      
      $fieldset->addField('slide_button', 'text', array(
          'label'     => Mage::helper('sofiaslider')->__('Button Text'),
          'required'  => false,
          'name'      => 'slide_button',
      ));
      $fieldset->addField('slide_width', 'text', array(
          'label'     => Mage::helper('sofiaslider')->__('Content width'),
          'required'  => false,
          'name'      => 'slide_width',
      ));
	  
	  $fieldset->addField('slide_link', 'text', array(
          'label'     => Mage::helper('sofiaslider')->__('Link'),
          'required'  => false,
          'name'      => 'slide_link',
      ));


	  $data = array();
	  $out = '';
	  if ( Mage::getSingleton('adminhtml/session')->getSofiasliderData() )
		{
			$data = Mage::getSingleton('adminhtml/session')->getSofiasliderData();
		} elseif ( Mage::registry('sofiaslider_data') ) {
			$data = Mage::registry('sofiaslider_data')->getData();
		}

	  if ( !empty($data['image']) ) {
		  $url = Mage::getBaseUrl('media') . $data['image'];
          $out = '<br/><center><a href="' . $url . '" target="_blank" id="imageurl">';
		  $out .= "<img src=" . $url . " width='150px' />";
		  $out .= '</a></center>';
	  }

      $fieldset->addField('image', 'file', array(
          'label'     => Mage::helper('sofiaslider')->__('Image'),
          'required'  => false,
          'name'      => 'image',
	      'note' => $out,
	  ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('sofiaslider')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('sofiaslider')->__('Enabled'),
              ),
              array(
                  'value'     => 2,
                  'label'     => Mage::helper('sofiaslider')->__('Disabled'),
              ),
          ),
      ));

      $fieldset->addField('sort_order', 'text', array(
            'label'     => Mage::helper('sofiaslider')->__('Sort Order'),
            'required'  => false,
            'name'      => 'sort_order',
        ));

      if ( Mage::getSingleton('adminhtml/session')->getSofiasliderData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getSofiasliderData());
          Mage::getSingleton('adminhtml/session')->getSofiasliderData(null);
      } elseif ( Mage::registry('sofiaslider_data') ) {
          $form->setValues(Mage::registry('sofiaslider_data')->getData());
      }
      return parent::_prepareForm();
  }
}