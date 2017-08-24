<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Ip_Tabmegamenu_Block_Admin_Tab_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {


    protected function _prepareForm() {
        $model = Mage::registry('tabmegamenu_tab');
        $form = new Varien_Data_Form(array('id' => 'edit_form_tab', 'action' => $this->getData('action'), 'method' => 'post'));
        $form->setHtmlIdPrefix('tab_');
        $fieldset = $form->addFieldset('base_fieldset', array('legend' => Mage::helper('tabmegamenu')->__('General Information'), 'class' => 'fieldset-wide'));
        if ($model->getTabId()) {
            $fieldset->addField('tab_id', 'hidden', array(
                'name' => 'tab_id',
            ));
        }

        $fieldset->addField('title', 'text', array(
            'name' => 'title',
            'label' => Mage::helper('tabmegamenu')->__('Title'),
            'title' => Mage::helper('tabmegamenu')->__('Title'),
            'required' => true,
        ));
        $fieldset->addField('url', 'text', array(
            'name' => 'url',
            'label' => Mage::helper('tabmegamenu')->__('Url'),
            'title' => Mage::helper('tabmegamenu')->__('Url'),
            'required' => false,
//            'style' => 'width:200px',
        ));
		
        $fieldset->addField('type', 'select', array(
            'name' => 'type',
            'label' => Mage::helper('tabmegamenu')->__('Type'),
            'title' => Mage::helper('tabmegamenu')->__('Type'),
            'required' => true,
            'options' => array(
                1 => Mage::helper('tabmegamenu')->__('Tab'),
                0 => Mage::helper('tabmegamenu')->__('Link'),
            ),
        ));

        $fieldset->addField('position', 'select', array(
            'name' => 'position',
            'label' => Mage::helper('tabmegamenu')->__('Position'),
            'title' => Mage::helper('tabmegamenu')->__('Position'),
            'required' => true,
            'options' => Mage::helper('tabmegamenu')->numberArray(20,Mage::helper('tabmegamenu')->__('')),
        ));
		
        $fieldset->addField('item_id', 'multiselect', array(
            'name' => 'items[]',
            'label' => Mage::helper('tabmegamenu')->__('Items'),
            'title' => Mage::helper('tabmegamenu')->__('Items'),
            'required' => false,
            'values' => Mage::getModel('tabmegamenu/data')->getItems4Form(),
            'style' => 'height:250px',
        ));		
        $fieldset->addField('category_id', 'multiselect', array(
            'name' => 'categories[]',
            'label' => Mage::helper('tabmegamenu')->__('Categories'),
            'title' => Mage::helper('tabmegamenu')->__('Categories'),
            'required' => false,
            'values' => Mage::getModel('tabmegamenu/data')->getCatalog4Form(),
            'style' => 'height:250px',
        ));				
		
        if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_id', 'multiselect', array(
                'name' => 'stores[]',
                'label' => Mage::helper('tabmegamenu')->__('Store View'),
                'title' => Mage::helper('tabmegamenu')->__('Store View'),
                'required' => true,
                'values' => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
            'style' => 'height:150px',
            ));
        } else {
            $fieldset->addField('store_id', 'hidden', array(
                'name' => 'stores[]',
                'value' => Mage::app()->getStore(true)->getId()
            ));
            $model->setStoreId(Mage::app()->getStore(true)->getId());
        }
        $fieldset->addField('align_tab', 'select', array(
            'label' => Mage::helper('tabmegamenu')->__('Align tab'),
            'title' => Mage::helper('tabmegamenu')->__('Align tab'),
            'name' => 'align_tab',
            'required' => true,
            'options' => array(
                'left' => Mage::helper('tabmegamenu')->__('Left'),
                'right' => Mage::helper('tabmegamenu')->__('Right'),
            ),
        ));
		$fieldset->addField('is_active', 'select', array(
            'label' => Mage::helper('tabmegamenu')->__('Status'),
            'title' => Mage::helper('tabmegamenu')->__('Status'),
            'name' => 'is_active',
            'required' => true,
            'options' => array(
                '1' => Mage::helper('tabmegamenu')->__('Enabled'),
                '0' => Mage::helper('tabmegamenu')->__('Disabled'),
            ),
        ));
        $dateFormatIso = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM);
        $fieldset->addField('from_time', 'date', array(
            'name' => 'from_time',
            'time' => true,
            'label' => Mage::helper('tabmegamenu')->__('From Time'),
            'title' => Mage::helper('tabmegamenu')->__('From Time'),
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'input_format' => Varien_Date::DATETIME_INTERNAL_FORMAT,
            'format' => $dateFormatIso,
        ));

        $fieldset->addField('to_time', 'date', array(
            'name' => 'to_time',
            'time' => true,
            'label' => Mage::helper('tabmegamenu')->__('To Time'),
            'title' => Mage::helper('tabmegamenu')->__('To Time'),
            'image' => $this->getSkinUrl('images/grid-cal.gif'),
            'input_format' => Varien_Date::DATETIME_INTERNAL_FORMAT,
            'format' => $dateFormatIso,
        ));


        if (Mage::helper('tabmegamenu')->versionUseWysiwig()) {
            $wysiwygConfig = Mage::getSingleton('tabmegamenu/wysiwyg_config')->getConfig();
        } else {
            $wysiwygConfig = '';
        }

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
