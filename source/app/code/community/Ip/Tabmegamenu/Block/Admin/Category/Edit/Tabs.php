<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Ip_Tabmegamenu_Block_Admin_Category_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

    public function __construct() {
        parent::__construct();
        $this->setId('tabmegamenu_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('tabmegamenu')->__('Category Information'));
    }

    protected function _beforeToHtml() {
        $this->addTab('form_section_category', array(
            'label' => Mage::helper('tabmegamenu')->__('General Information'),
            'title' => Mage::helper('tabmegamenu')->__('General Information'),
            'content' => $this->getLayout()->createBlock('tabmegamenu/admin_category_edit_tab_form')->toHtml(),
        ));
        $this->addTab('form_section_other', array(
            'label' => Mage::helper('tabmegamenu')->__('Content Information'),
            'title' => Mage::helper('tabmegamenu')->__('Content Information'),
            'content' => $this->getLayout()->createBlock('tabmegamenu/admin_category_edit_tab_other')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }

}