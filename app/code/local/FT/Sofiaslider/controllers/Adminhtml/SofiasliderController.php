<?php

class FT_Sofiaslider_Adminhtml_SofiasliderController extends Mage_Adminhtml_Controller_Action
{

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')
            ->isAllowed('frexy/sofia/sofiaslider');
    }

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('frexy/sofia/sofiaslider/items')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Slide Manager'), Mage::helper('adminhtml')->__('Slide Manager'));
		
		return $this;
	}   
 
	public function indexAction() {
		$this->_initAction()
			->_addContent($this->getLayout()->createBlock('sofiaslider/adminhtml_sofiaslider'))
			->renderLayout();
	}

	public function editAction() {
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('sofiaslider/sofiaslider')->load($id);

		if ($model->getId() || $id == 0) {

			$this->_initAction();

			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('sofiaslider_data', $model);

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

			$this->_addContent($this->getLayout()->createBlock('sofiaslider/adminhtml_sofiaslider_edit'))
				->_addLeft($this->getLayout()->createBlock('sofiaslider/adminhtml_sofiaslider_edit_tabs'));

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('sofiaslider')->__('Slide does not exist'));
			$this->_redirect('*/*/');
		}
	}
 
	public function newAction() {
		$this->_forward('edit');
	}
 
	public function saveAction() {
		if ($data = $this->getRequest()->getPost()) {
			
			if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != null) {
                $result['file'] = '';
				try {	
					/* Starting upload */	
					$uploader = new Varien_File_Uploader('image');
					
					// Any extention would work
	           		$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
					$uploader->setAllowRenameFiles(false);
					
					// Set the file upload mode 
					// false -> get the file directly in the specified folder
					// true -> get the file in the product like folders 
					//	(file.jpg will go in something like /media/f/i/file.jpg)
					$uploader->setFilesDispersion(false);
							
					// We set media as the upload dir
					$path = Mage::getBaseDir('media') . DS.'frexy/sofia/sofiaslider'.DS ;
					$result = $uploader->save($path, $_FILES['image']['name'] );
					
				} catch (Exception $e) {
					Mage::getSingleton('adminhtml/session')->addError($e->getMessage() . '  '. $path);
	                Mage::getSingleton('adminhtml/session')->setFormData($data);
	                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
	                return;
		        }
	        
		        $data['image'] = 'frexy/sofia/sofiaslider/'.$result['file'];
			}

            if(isset($_FILES['small_image']['name']) && $_FILES['small_image']['name'] != null) {
                $result['file'] = '';
				try {
					/* Starting upload */
					$uploader = new Varien_File_Uploader('small_image');
	           		$uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
					$uploader->setAllowRenameFiles(false);
					$uploader->setFilesDispersion(false);
					$path = Mage::getBaseDir('media') . DS.'frexy/sofia/sofiaslider'.DS ;
					$result = $uploader->save($path, $_FILES['small_image']['name'] );
				} catch (Exception $e) {
					Mage::getSingleton('adminhtml/session')->addError($e->getMessage() . '  '. $path);
	                Mage::getSingleton('adminhtml/session')->setFormData($data);
	                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
	                return;
		        }

		        $data['small_image'] = 'frexy/sofia/sofiaslider/'.$result['file'];
			}
	  			
	  			
			$model = Mage::getModel('sofiaslider/sofiaslider');
			$model->setData($data)
				->setId($this->getRequest()->getParam('id'));

			try {
				if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
					$model->setCreatedTime(now())
						->setUpdateTime(now());
				} else {
					$model->setUpdateTime(now());
				}	
				
				$model->save();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('sofiaslider')->__('Slide was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);

				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', array('id' => $model->getId()));
					return;
				}
				$this->_redirect('*/*/');
				return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('sofiaslider')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
	}
 
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('sofiaslider/sofiaslider');
				 
				$model->setId($this->getRequest()->getParam('id'))
					->delete();
					 
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Slide was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}

    public function massDeleteAction() {
        $sofiasliderIds = $this->getRequest()->getParam('sofiaslider');
        if(!is_array($sofiasliderIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select slide(s)'));
        } else {
            try {
                foreach ($sofiasliderIds as $sofiasliderId) {
                    $sofiaslider = Mage::getModel('sofiaslider/sofiaslider')->load($sofiasliderId);
                    $sofiaslider->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($sofiasliderIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
	
    public function massStatusAction()
    {
        $sofiasliderIds = $this->getRequest()->getParam('sofiaslider');
        if(!is_array($sofiasliderIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select slide(s)'));
        } else {
            try {
                foreach ($sofiasliderIds as $sofiasliderId) {
                    $sofiaslider = Mage::getSingleton('sofiaslider/sofiaslider')
                        ->load($sofiasliderId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($sofiasliderIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
  
    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream')
    {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK','');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename='.$fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Lenfth', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }
}