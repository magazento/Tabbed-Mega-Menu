<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php
class Ip_Tabmegamenu_Model_Tab extends Mage_Core_Model_Abstract
{
    const CACHE_TAG     = 'tabmegamenu_admin_tab';
    protected $_cacheTag= 'tabmegamenu_admin_tab';

    protected function _construct()
    {
        $this->_init('tabmegamenu/tab');


    }

}
