<?php
/*
 *  Created on Mar 16, 2011
 *  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
 *  Copyright Proskuryakov Ivan. Magazento.com © 2011. All Rights Reserved.
 *  Single Use, Limited Licence and Single Use No Resale Licence [\\"Single Use\\"]
 */
?>
<?php

$installer = $this;
$installer->startSetup();
$installer->run("

--
-- Table structure for table ip_tabmegamenu_category`
--

CREATE TABLE IF NOT EXISTS {$this->getTable('ip_tabmegamenu_category')} (
  `category_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `catalog_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `url` text NOT NULL,
  `column` tinyint(4) NOT NULL DEFAULT '2',
  `position` tinyint(4) NOT NULL DEFAULT '0',
  `align_category` varchar(10) NOT NULL DEFAULT 'left',
  `align_content` varchar(10) NOT NULL DEFAULT 'right',
  `content_top` text CHARACTER SET utf8 COLLATE utf8_bin,
  `content_bottom` text CHARACTER SET utf8 COLLATE utf8_bin,
  `from_time` datetime DEFAULT NULL,
  `to_time` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table ip_tabmegamenu_category_store`
--

CREATE TABLE IF NOT EXISTS {$this->getTable('ip_tabmegamenu_category_store')} (
  `category_id` smallint(6) unsigned DEFAULT NULL,
  `store_id` smallint(6) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table ip_tabmegamenu_item`
--

CREATE TABLE IF NOT EXISTS {$this->getTable('ip_tabmegamenu_item')} (
  `item_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `column` tinyint(4) NOT NULL DEFAULT '2',
  `align_item` varchar(10) NOT NULL DEFAULT 'left',
  `align_content` varchar(10) NOT NULL DEFAULT 'right',
  `position` tinyint(10) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `from_time` datetime DEFAULT NULL,
  `to_time` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `columnsize` tinyint(4) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table ip_tabmegamenu_item_store`
--

CREATE TABLE IF NOT EXISTS {$this->getTable('ip_tabmegamenu_item_store')} (
  `item_id` smallint(6) unsigned DEFAULT NULL,
  `store_id` smallint(6) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table ip_tabmegamenu_tab
--

CREATE TABLE IF NOT EXISTS {$this->getTable('ip_tabmegamenu_tab')} (
  `tab_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `type` tinyint(4) NOT NULL,
  `position` tinyint(10) NOT NULL DEFAULT '0',
  `align_tab` varchar(10) NOT NULL,
  `css_style` text NOT NULL,
  `css_class` varchar(100) NOT NULL,
  `css_style_content` text NOT NULL,
  `css_class_content` varchar(100) NOT NULL,
  `from_time` datetime DEFAULT NULL,
  `to_time` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tab_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Table structure for table ip_tabmegamenu_tab_category`
--

CREATE TABLE IF NOT EXISTS {$this->getTable('ip_tabmegamenu_tab_category')} (
  `tab_id` smallint(6) unsigned DEFAULT NULL,
  `category_id` smallint(6) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table ip_tabmegamenu_tab_item
--

CREATE TABLE IF NOT EXISTS {$this->getTable('ip_tabmegamenu_tab_item')} (
  `tab_id` smallint(6) unsigned DEFAULT NULL,
  `item_id` smallint(6) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table ip_tabmegamenu_tab_store
--

CREATE TABLE IF NOT EXISTS {$this->getTable('ip_tabmegamenu_tab_store')} (
  `tab_id` smallint(6) unsigned DEFAULT NULL,
  `store_id` smallint(6) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



");

$installer->endSetup();
?>