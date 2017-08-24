<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Ip_Tabmegamenu_Block_Admin_Category_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {


    protected function _prepareForm() {
        $model = Mage::registry('tabmegamenu_category');
        $form = new Varien_Data_Form(array('id' => 'edit_form_category', 'action' => $this->getData('action'), 'method' => 'post'));
        $form->setHtmlIdPrefix('category_');
        $fieldset = $form->addFieldset('base_fieldset', array('legend' => Mage::helper('tabmegamenu')->__('General Information'), 'class' => 'fieldset-wide'));
        if ($model->getCategoryId()) {
            $fieldset->addField('category_id', 'hidden', array(
                'name' => 'category_id',
            ));
        }

        $fieldset->addField('title', 'text', array(
            'name' => 'title',
            'label' => Mage::helper('tabmegamenu')->__('Title'),
            'title' => Mage::helper('tabmegamenu')->__('Title'),
            'required' => true,
//            'style' => 'width:200px',
        ));

        $fieldset->addField('url', 'text', array(
            'name' => 'url',
            'label' => Mage::helper('tabmegamenu')->__('Url'),
            'title' => Mage::helper('tabmegamenu')->__('Url'),
            'required' => false,
            'comment' => 'tadaada',
        ));

        $fieldset->addField('catalog_id', 'select', array(
            'name' => 'catalog_id',
            'label' => Mage::helper('tabmegamenu')->__('Catalog ID'),
            'title' => Mage::helper('tabmegamenu')->__('Catalog ID'),
            'required' => true,
            'values' => Mage::getModel('tabmegamenu/data')->storeCategories4Form(),
            'style' => 'width:100%',            
        ));

        $fieldset->addField('position', 'select', array(
            'name' => 'position',
            'label' => Mage::helper('tabmegamenu')->__('Position'),
            'title' => Mage::helper('tabmegamenu')->__('Position'),
            'required' => true,
            'options' => Mage::helper('tabmegamenu')->numberArray(20,Mage::helper('tabmegamenu')->__('')),
        ));


        $fieldset->addField('column', 'select', array(
            'name' => 'column',
            'label' => Mage::helper('tabmegamenu')->__('Columns'),
            'title' => Mage::helper('tabmegamenu')->__('Columns'),
            'required' => true,
            'options' => Mage::helper('tabmegamenu')->numberArray(5,Mage::helper('tabmegamenu')->__('')),
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

//        $fieldset->addField('column', 'select', array(
//            'name' => 'column',
//            'label' => Mage::helper('tabmegamenu')->__('Column'),
//            'title' => Mage::helper('tabmegamenu')->__('Column'),
//            'required' => true,
//            'options' =>  Mage::helper('tabmegamenu')->numberArray(5,Mage::helper('tabmegamenu')->__('')),
//        ));

        $fieldset->addField('align_category', 'select', array(
            'label' => Mage::helper('tabmegamenu')->__('Align category'),
            'title' => Mage::helper('tabmegamenu')->__('Align category'),
            'name' => 'align_category',
            'required' => true,
            'options' => array(
                'left' => Mage::helper('tabmegamenu')->__('Left'),
                'right' => Mage::helper('tabmegamenu')->__('Right'),
            ),
        ));
        $fieldset->addField('align_content', 'select', array(
            'label' => Mage::helper('tabmegamenu')->__('Align content'),
            'title' => Mage::helper('tabmegamenu')->__('Align content'),
            'name' => 'align_content',
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

//        print_r($model->getData());
//        exit();
//        $form->setUseContainer(true);
        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
