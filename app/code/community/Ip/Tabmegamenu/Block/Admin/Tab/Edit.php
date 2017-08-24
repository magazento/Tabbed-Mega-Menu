<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Ip_Tabmegamenu_Block_Admin_Tab_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    public function __construct()
    {
    	$this->_objectId = 'tab_id';
        $this->_controller = 'admin_tab';
        $this->_blockGroup = 'tabmegamenu';

        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('tabmegamenu')->__('Save tab'));
        $this->_updateButton('delete', 'label', Mage::helper('tabmegamenu')->__('Delete tab'));
        
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);
        

        $this->_formScripts[] = "
           function toggleEditor() {
                if (tinyMCE.getInstanceById('block_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'block_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'block_content');
                }
            }
            
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
            
        ";
    }

    public function getHeaderText()
    {
        if (Mage::registry('tabmegamenu_tab')->getId()) {
            return Mage::helper('tabmegamenu')->__("Edit tab '%s'", $this->htmlEscape(Mage::registry('tabmegamenu_tab')->getTitle()));
        }
        else {
            return Mage::helper('tabmegamenu')->__('New tab');
        }
    }

}
