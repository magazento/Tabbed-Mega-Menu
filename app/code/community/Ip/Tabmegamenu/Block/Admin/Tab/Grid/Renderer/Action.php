<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php


class Ip_Tabmegamenu_Block_Admin_Tab_Grid_Renderer_Action extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Action
{
	    public function render(Varien_Object $row)
	    {
	
	        $actions[] = array(
	        	'url' => $this->getUrl('*/*/edit', array('tab_id' => $row->getId())),
	        	'caption' => Mage::helper('tabmegamenu')->__('Edit')
	         );
		     
	         $actions[] = array(
	        	'url' => $this->getUrl('*/*/delete', array('tab_id' => $row->getId())),
	        	'caption' => Mage::helper('tabmegamenu')->__('Delete'),
	        	'confirm' => Mage::helper('tabmegamenu')->__('Are you sure you want to delete this tab ?')
	         );
	
	        $this->getColumn()->setActions($actions);
	
	        return parent::render($row);
	    }
}
