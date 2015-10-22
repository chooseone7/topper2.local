<?php
class FT_Sofiaslider_Block_Slideshow extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
    public function getSlideshow()
    {
        if (!$this->hasData('sofiaslider')) {
            $this->setData('sofiaslider', Mage::registry('sofiaslider'));
        }
        return $this->getData('sofiaslider');
        
    }

	public function getSlides()
    {
        $slides  = Mage::getModel('sofiaslider/sofiaslider')->getCollection()
            ->addStoreFilter(Mage::app()->getStore())
        	->addFieldToSelect('*')
        	->addFieldToFilter('status', 1)
            ->setOrder('sort_order', 'asc');
        return $slides;
    }

}