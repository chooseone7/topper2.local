<?php

class FT_Sofiaadmin_Adminhtml_ActivateController extends Mage_Adminhtml_Controller_Action
{

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')
            ->isAllowed('frexy/sofia/activate');
    }

    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('frexy/sofia/activate')
            ->_addBreadcrumb(Mage::helper('sofiaadmin')->__('Activate Sofia Theme'),
                Mage::helper('sofiaadmin')->__('Activate Sofia Theme'));

        return $this;
    }

	public function indexAction()
	    {
	        $this->_initAction();
	        $this->_title($this->__('Frexy'))
	            ->_title($this->__('Sofia'))
	            ->_title($this->__('Activate Sofia Theme'));

	        $this->_addContent($this->getLayout()->createBlock('sofiaadmin/adminhtml_activate_edit'));
	        $block = $this->getLayout()->createBlock('core/text', 'activate-desc')
	                ->setText('<big><b>Activate will update following settings:</b></big>
	                        <br/><br/>
	                        <big>System > Config</big><br/><br/>
	                        <b>Web > Default pages</b>
	                        <ul>
	                            <li>CMS Home Page</li>
	                            <li>CMS No Route Page</li>
	                        </ul>
	                        <b>Design > Themes</b>
	                        <ul>
	                            <li>Default</li>
	                        </ul>
	                        <b>Design > Header</b>
	                        <ul>
	                            <li>Logo Img Src</li>
	                        </ul>
	                        <b>Design > Footer</b>
	                        <ul>
	                            <li>Copyright</li>
	                        </ul>
	                        <b>Currency Setup > Currency Options</b>
	                        <ul>
	                            <li>Allowed currencies</li>
	                        </ul>
	                        ');
	        $this->_addLeft($block);

	        $this->renderLayout();
	    }

	public function activateAction()
    {
        $stores = $this->getRequest()->getParam('stores', array(0));
        $update_currency = $this->getRequest()->getParam('update_currency', 0);
        $setup_cms = $this->getRequest()->getParam('setup_cms', 0);
        
        try {
	        foreach ($stores as $store) {
                $scope = ($store ? 'stores' : 'default');
		        //web > default pages
                Mage::getConfig()->saveConfig('web/default/cms_home_page', 'sofia_home_1col', $scope, $store);
                //Mage::getConfig()->saveConfig('web/default/cms_no_route', 'sofia_no_route', $scope, $store);
		        //design > themes
                Mage::getConfig()->saveConfig('design/package/name', 'ft001-sofia', $scope, $store);
                Mage::getConfig()->saveConfig('design/theme/default', 'default', $scope, $store);
                //design > header
                //Mage::getConfig()->saveConfig('design/header/logo_src', 'images/logo.png', $scope, $store);
                //design > footer
                Mage::getConfig()->saveConfig('design/footer/copyright', 'Sofia &copy; 2012 <a href="http://frexythemes.com" >Premium Magento Themes</a> by Frexythemes', $scope, $store);
                //Currency Setup > Currency Options
                if ($update_currency) {
                    Mage::getConfig()->saveConfig('currency/options/allow', 'GBP,EUR,USD', $scope, $store);
                }
            }

	        if ($setup_cms) {
                Mage::getModel('sofiaadmin/settings')->setupCms();
	        }

		    Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('sofiaadmin')->__('Sofia Theme has been activated.<br/>
                Please clear cache (System > Cache management) if you do not see changes in storefront.<br/>
                To update currencies rates please go to System -> Manage Currency Rates. Press import.
                Wait for message "All rates were fetched..." and press save.<br/>
                <b>IMPORTANT !!!. Log out from magento admin panel ( if you logged in ). This step is required to reset magento
                access control cache and avoid 404 message on theme options page</b>
                '));
        }
        catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('sofiaadmin')->__('An error occurred while activating theme. '.$e->getMessage()));
        }

        $this->getResponse()->setRedirect($this->getUrl("*/*/"));
    }

	private function _updateNewest()
	{

	}

	private function _updateSale()
	{

	}

}