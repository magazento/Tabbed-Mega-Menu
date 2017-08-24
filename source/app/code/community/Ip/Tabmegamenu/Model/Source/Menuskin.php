<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Ip_Tabmegamenu_Model_Source_Menuskin {

    public function toOptionArray() {
        return array(
            array('value' => 'menuredtabs', 'label' => Mage::helper('tabmegamenu')->__('Redtabs')),
            array('value' => 'menured', 'label' => Mage::helper('tabmegamenu')->__('Red')),
            array('value' => 'menublue','label' => Mage::helper('tabmegamenu')->__('Blue')),
        );
    }

}