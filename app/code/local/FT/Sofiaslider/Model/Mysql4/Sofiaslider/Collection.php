<?php

class FT_Sofiaslider_Model_Mysql4_Sofiaslider_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('sofiaslider/sofiaslider');
    }

	/**
     * Add Filter by store
     *
     * @param Mage_Core_Model_Store $store
	 * @param bool $withAdmin
	 * @return FT_Sofiaslider_Model_Mysql4_Sofiaslider_Collection
	 */
	public function addStoreFilter($store, $withAdmin = true)
	{
		if ($store instanceof Mage_Core_Model_Store) {
			$store = array($store->getId());
		}

		$this->getSelect()->join(
			array('store_table' => $this->getTable('sofiaslider/slides_store')),
			'main_table.slide_id = store_table.slide_id',
			array()
		)
		->where('store_table.store_id in (?)', ($withAdmin ? array(0, $store) : $store));

		return $this;
	}
}