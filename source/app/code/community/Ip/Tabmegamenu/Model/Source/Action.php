<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Ip_Tabmegamenu_Model_Source_Action {

    public function toOptionArray() {
        return array(
            array('value' => 'click', 'label' => Mage::helper('tabmegamenu')->__('Click')),
            array('value' => 'hover','label' => Mage::helper('tabmegamenu')->__('Hover')),

        );
    }

}