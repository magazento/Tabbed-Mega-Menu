<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Ip_Tabmegamenu_Block_Admin_Tab_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId('tabmegamenu_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('tabmegamenu')->__('Tab Information'));
    }

    protected function _beforeToHtml() {
        $this->addTab('form_section_tab', array(
            'label' => Mage::helper('tabmegamenu')->__('Tab Information'),
            'title' => Mage::helper('tabmegamenu')->__('Tab Information'),
            'content' => $this->getLayout()->createBlock('tabmegamenu/admin_tab_edit_tab_form')->toHtml(),
        ));
       $this->addTab('form_section_other', array(
           'label' => Mage::helper('tabmegamenu')->__('CSS & DESIGN'),
           'title' => Mage::helper('tabmegamenu')->__('CSS & DESIGN'),
           'content' => $this->getLayout()->createBlock('tabmegamenu/admin_tab_edit_tab_other')->toHtml(),
       ));

        return parent::_beforeToHtml();
    }

}