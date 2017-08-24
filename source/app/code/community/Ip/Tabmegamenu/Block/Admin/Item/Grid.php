<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
 */
?>
<?php

class Ip_Tabmegamenu_Block_Admin_Item_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId('TabmegamenuGrid');
        $this->setDefaultSort('position');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareCollection() {
        $collection = Mage::getModel('tabmegamenu/item')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {

        $baseUrl = $this->getUrl();
        $this->addColumn('item_id', array(
            'header' => Mage::helper('tabmegamenu')->__('ID'),
            'align' => 'left',
            'width' => '30px',
            'index' => 'item_id',
        ));
        $this->addColumn('title', array(
            'header' => Mage::helper('tabmegamenu')->__('Title'),
            'align' => 'left',
            'index' => 'title',
        ));

        $this->addColumn('position', array(
            'header' => Mage::helper('tabmegamenu')->__('Pos'),
            'align' => 'left',
            'index' => 'position',
            'width' => '20px',
            'type'  => 'options',
            'options' => Mage::helper('tabmegamenu')->numberArray(20,Mage::helper('tabmegamenu')->__('')),
        ));
        $this->addColumn('url', array(
            'header' => Mage::helper('tabmegamenu')->__('Url'),
            'align' => 'left',
            'index' => 'url',
//            'width' => '100px',
        ));
        $this->addColumn('column', array(
            'header' => Mage::helper('tabmegamenu')->__('Cols'),
            'align' => 'left',
            'index' => 'column',
            'width' => '20px',
            'type'  => 'options',
            'options' => array(
                '1' => Mage::helper('tabmegamenu')->__('1'),
                '2' => Mage::helper('tabmegamenu')->__('2'),
                '3' => Mage::helper('tabmegamenu')->__('3'),
                '4' => Mage::helper('tabmegamenu')->__('4'),
                '5' => Mage::helper('tabmegamenu')->__('5'),                                                
            )            
        ));

        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_id', array(
                'header'        => Mage::helper('tabmegamenu')->__('Store View'),
                'index'         => 'store_id',
                'type'          => 'store',
                'store_all'     => true,
                'store_view'    => true,
                'sortable'      => false,
                'filter_condition_callback'
                                => array($this, '_filterStoreCondition'),
            ));
        }
        $this->addColumn('align_item', array(
            'header' => Mage::helper('tabmegamenu')->__('Align item'),
            'align' => 'left',
            'index' => 'align_item',
            'width' => '30px',
            'type'  => 'options',
            'options' => array(
                'left' => Mage::helper('tabmegamenu')->__('Left'),
                'right' => Mage::helper('tabmegamenu')->__('Right'),
            )

            ));
        $this->addColumn('align_content', array(
            'header' => Mage::helper('tabmegamenu')->__('Align content'),
            'align' => 'left',
            'index' => 'align_content',
            'width' => '30px',
            'type'  => 'options',
            'options' => array(
                'left' => Mage::helper('tabmegamenu')->__('Left'),
                'right' => Mage::helper('tabmegamenu')->__('Right'),
            )
        ));
        $this->addColumn('is_active', array(
            'header' => Mage::helper('tabmegamenu')->__('Status'),
            'index' => 'is_active',
            'type' => 'options',
            'options' => array(
                0 => Mage::helper('tabmegamenu')->__('Disabled'),
                1 => Mage::helper('tabmegamenu')->__('Enabled'),
            ),
        ));

        $this->addColumn('from_time', array(
            'header' => Mage::helper('tabmegamenu')->__('From Time'),
            'index' => 'from_time',
            'type' => 'datetime',
        ));

        $this->addColumn('to_time', array(
            'header' => Mage::helper('tabmegamenu')->__('To Time'),
            'index' => 'to_time',
            'type' => 'datetime',
        ));

        $this->addColumn('action',
                array(
                    'header' => Mage::helper('tabmegamenu')->__('Action'),
                    'index' => 'item_id',
                    'sortable' => false,
                    'filter' => false,
                    'no_link' => true,
                    'width' => '100px',
                    'renderer' => 'tabmegamenu/admin_item_grid_renderer_action'
        ));
        $this->addExportType('*/*/exportCsv', Mage::helper('tabmegamenu')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('tabmegamenu')->__('XML'));
        return parent::_prepareColumns();
    }

    protected function _afterLoadCollection() {
        $this->getCollection()->walk('afterLoad');
        parent::_afterLoadCollection();
    }

    protected function _filterStoreCondition($collection, $column) {
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }
        $this->getCollection()->addStoreFilter($value);
    }

    protected function _prepareMassaction() {
        $this->setMassactionIdField('item_id');
        $this->getMassactionBlock()->setFormFieldName('massaction');
        $this->getMassactionBlock()->addItem('delete', array(
            'label' => Mage::helper('tabmegamenu')->__('Delete'),
            'url' => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('tabmegamenu')->__('Are you sure?')
        ));

        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('tabmegamenu')->__('Change status'),
            'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('tabmegamenu')->__('Status'),
                    'values' => array(
                        0 => Mage::helper('tabmegamenu')->__('Disabled'),
                        1 => Mage::helper('tabmegamenu')->__('Enabled'),
                    ),
                )
            )
        ));
        return $this;
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('item_id' => $row->getId()));
    }

}
