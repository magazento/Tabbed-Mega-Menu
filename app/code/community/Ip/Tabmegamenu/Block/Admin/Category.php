<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Ip_Tabmegamenu_Block_Admin_Category extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'admin_category';
        $this->_blockGroup = 'tabmegamenu';
        $this->_headerText = Mage::helper('tabmegamenu')->__('Tabmegamenu Category grid');
        $this->_addButtonLabel = Mage::helper('tabmegamenu')->__('Add New Category');
        parent::__construct();
    }

}
