<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Ip_Tabmegamenu_Admin_TabController extends Mage_Adminhtml_Controller_Action {

    protected function _initAction() {
        $this->loadLayout()
                ->_setActiveMenu('ip/tabmegamenu')
                ->_addBreadcrumb(Mage::helper('tabmegamenu')->__('Tabmegamenu'), Mage::helper('tabmegamenu')->__('Tabmegamenu'))
                ->_addBreadcrumb(Mage::helper('tabmegamenu')->__('Tabmegamenu Items'), Mage::helper('tabmegamenu')->__('Tabmegamenu Items'))
        ;
        return $this;
    }

    public function indexAction() {
        $this->_initAction()
                ->_addContent($this->getLayout()->createBlock('tabmegamenu/admin_tab'))
                ->renderLayout();
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function editAction() {
        if (Mage::helper('tabmegamenu')->versionUseAdminTitle()) {
            $this->_title($this->__('tabmegamenu'));
        }
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('tab_id');
        $model = Mage::getModel('tabmegamenu/tab');
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tabmegamenu')->__('This tab no longer exists'));
                $this->_redirect('*/*/');
                return;
            }
        }
        // 3. Set entered data if was error when we do save
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        // 4. Register model to use later in blocks
        Mage::register('tabmegamenu_tab', $model);
        // 5. Build edit form
        $this->_initAction()
                ->_addBreadcrumb($id ? Mage::helper('tabmegamenu')->__('Edit Item') : Mage::helper('tabmegamenu')->__('New Item'), $id ? Mage::helper('tabmegamenu')->__('Edit Item') : Mage::helper('tabmegamenu')->__('New Item'))
                ->_addContent($this->getLayout()->createBlock('tabmegamenu/admin_tab_edit')->setData('action', $this->getUrl('*/admin_tab/save')))
                ->_addLeft($this->getLayout()->createBlock('tabmegamenu/admin_tab_edit_tabs'))
                ->renderLayout();
    }

    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {
        	
            // init model and set data
            $model = Mage::getModel('tabmegamenu/tab');
//            print_r($data);exit();
            $model->setData($data);
            // try to save it
            try {
                // save the data
                $model->save();
                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('tabmegamenu')->__('Item was successfully saved'));
                // clear previously saved data from session
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                // check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('tab_id' => $model->getId()));
                    return;
                }
                // go to grid
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                // display error message
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                // save data in session
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                // redirect to edit form
                $this->_redirect('*/*/edit', array('tab_id' => $this->getRequest()->getParam('tab_id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }

    public function deleteAction() {
        // check if we know what should be deleted
        if ($id = $this->getRequest()->getParam('tab_id')) {
            $name = "";
            try {
                // init model and delete
                $model = Mage::getModel('tabmegamenu/tab');
                $model->load($id);
                $name = $model->getName();
                $model->delete();
                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('tabmegamenu')->__('Item was successfully deleted'));
                // go to grid
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                // display error message
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                // go back to edit form
                $this->_redirect('*/*/edit', array('tab_id' => $id));
                return;
            }
        }
        // display error message
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tabmegamenu')->__('Unable to find a tab to delete'));
        // go to grid
        $this->_redirect('*/*/');
    }


    protected function _isAllowed() {
        return Mage::getSingleton('admin/session')->isAllowed('tabmegamenu/tab');
    }

    public function wysiwygAction() {
        $elementId = $this->getRequest()->getParam('element_id', md5(microtime()));
        $content = $this->getLayout()->createBlock('adminhtml/catalog_helper_form_wysiwyg_content', '', array(
                    'editor_element_id' => $elementId
                ));
        $this->getResponse()->setBody($content->toHtml());
    }



    public function massStatusAction()
    {
        $tabIds = $this->getRequest()->getParam('massaction');
        if(!is_array($tabIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select tab(s)'));
        } else {
            try {
                foreach ($tabIds as $tabId) {
                    $model = Mage::getSingleton('tabmegamenu/tab')
                        ->load($tabId)
                        ->setIs_active($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($tabIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
   public function massDeleteAction() {
        $tabIds = $this->getRequest()->getParam('massaction');
        if(!is_array($tabIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('tabmegamenu')->__('Please select tab(s)'));
        } else {
            try {
                foreach ($tabIds as $tabId) {
                    $mass = Mage::getModel('tabmegamenu/tab')->load($tabId);
                    $mass->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('tabmegamenu')->__(
                        'Total of %d record(s) were successfully deleted', count($tabIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    
    public function exportCsvAction()
    {
        $fileName   = 'tabs.csv';
        $content    = $this->getLayout()->createBlock('tabmegamenu/admin_tab_grid')
            ->getCsv();
        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'tabs.xml';
        $content    = $this->getLayout()->createBlock('tabmegamenu/admin_tab_grid')
            ->getXml();
        $this->_sendUploadResponse($fileName, $content);
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
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }
}