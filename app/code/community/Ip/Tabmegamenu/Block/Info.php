<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>

<?php

class Ip_Tabmegamenu_Block_Info extends Mage_Adminhtml_Block_System_Config_Form_Fieldset {

    public function __construct() {
        parent::__construct();
    }
    public function render(Varien_Data_Form_Element_Abstract $element) {
        $html = $this->_getHeaderHtml($element);
        $html.= $this->_getFieldHtml($element);
        $html .= $this->_getFooterHtml($element);
        return $html;
    }
    protected function _getFieldHtml($fieldset) {
        $content = 'This extension is developed by <a href="http://www.ecommerceoffice.com/" target="_blank">www.ecommerceoffice.com</a><br/>';
        $content.= 'Magento Store Setup, modules, data migration, templates, upgrades and much more!';
        return $content;
    }

}
