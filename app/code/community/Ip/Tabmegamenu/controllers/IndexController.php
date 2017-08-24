<?php
class Ip_Tabmegamenu_IndexController extends Mage_Core_Controller_Front_Action {
  
    public function indexAction() {
       $tabId = (int)$this->getRequest()->getParam('tabId');
       Mage::getModel('core/session')->setData('currentMenuTab',$tabId);        
       Mage::log('menustate = '.Mage::getModel('core/session')->getData('currentMenuTab'),null,'tabmegamenu.log');
    }
    
    public function getcurrenttabAction() {
       echo Mage::getModel('core/session')->getData('currentMenuTab');        
    }    
}
