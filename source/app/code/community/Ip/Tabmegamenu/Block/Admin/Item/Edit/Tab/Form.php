<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Ip_Tabmegamenu_Block_Admin_Item_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {


    protected function _prepareForm() {
        $model = Mage::registry('tabmegamenu_item');
        $form = new Varien_Data_Form(array('id' => 'edit_form_item', 'action' => $this->getData('action'), 'method' => 'post'));
        $form->setHtmlIdPrefix('item_');
        $fieldset = $form->addFieldset('base_fieldset', array('legend' => Mage::helper('tabmegamenu')->__('General Information'), 'class' => 'fieldset-wide'));
        if ($model->getItemId()) {
            $fieldset->addField('item_id', 'hidden', array(
                'name' => 'item_id',
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
//            'style' => 'width:200px',
        ));

        $fieldset->addField('position', 'select', array(
            'name' => 'position',
            'label' => Mage::helper('tabmegamenu')->__('Position'),
            'title' => Mage::helper('tabmegamenu')->__('Position'),
            'required' => true,
            'options' => Mage::helper('tabmegamenu')->numberArray(20,Mage::helper('tabmegamenu')->__('')),
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
		
		$columns = Mage::helper('tabmegamenu')->numberArray(5,Mage::helper('tabmegamenu')->__(''));
		array_unshift($columns,'Only link (no content)');
        $fieldset->addField('column', 'select', array(
            'name' => 'column',
            'label' => Mage::helper('tabmegamenu')->__('Column'),
            'title' => Mage::helper('tabmegamenu')->__('Column'),
            'required' => true,
            'options' =>  $columns,
        ));

        $fieldset->addField('align_item', 'select', array(
            'label' => Mage::helper('tabmegamenu')->__('Align item'),
            'title' => Mage::helper('tabmegamenu')->__('Align item'),
            'name' => 'align_item',
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


        if (Mage::helper('tabmegamenu')->versionUseWysiwig()) {
            $wysiwygConfig = Mage::getSingleton('tabmegamenu/wysiwyg_config')->getConfig();
        } else {
            $wysiwygConfig = '';
        }

        $fieldset->addField('content', 'editor', array(
            'name' => 'content',
            'label' => Mage::helper('tabmegamenu')->__('Content'),
            'title' => Mage::helper('tabmegamenu')->__('Content'),
            'style' => 'height:36em',
            'config' => $wysiwygConfig,
            'required' => false,
        ));

        $fieldset->addField('script_java', 'note', array(
            'text' => '<script type="text/javascript">
				            var inputDateFrom = document.getElementById(\'item_from_time\');
				            var inputDateTo = document.getElementById(\'item_to_time\');
            				inputDateTo.onchange=function(){dateTestAnterior(this)};
				            inputDateFrom.onchange=function(){dateTestAnterior(this)};


				            function dateTestAnterior(inputChanged){
				            	dateFromStr=inputDateFrom.value;
				            	dateToStr=inputDateTo.value;

				            	if(dateFromStr.indexOf(\'.\')==-1)
				            		dateFromStr=dateFromStr.replace(/(\d{1,2} [a-zA-Zâêûîôùàçèé]{3})[^ \.]+/,"$1.");
				            	if(dateToStr.indexOf(\'.\')==-1)
				            		dateToStr=dateToStr.replace(/(\d{1,2} [a-zA-Zâêûîôùàçèé]{3})[^ \.]+/,"$1.");

				            	fromDate= Date.parseDate(dateFromStr,"%e %b %Y %H:%M:%S");
				            	toDate= Date.parseDate(dateToStr,"%e %b %Y %H:%M:%S");

				            	if(dateToStr!=\'\'){
					            	if(fromDate>toDate){
	            						inputChanged.value=\'\';
	            						alert(\'' . Mage::helper('tabmegamenu')->__('You must set a date to value greater than the date from value') . '\');
					            	}
				            	}
            				}
            			</script>',
            'disabled' => true
        ));
//        print_r($model->getData());
//        exit();
//        $form->setUseContainer(true);
        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
