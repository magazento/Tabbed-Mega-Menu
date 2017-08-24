-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 27, 2011 at 02:06 PM
-- Server version: 5.5.18
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `magento16`
--

-- --------------------------------------------------------

--
-- Table structure for table `ip_tabmegamenu_category`
--

CREATE TABLE IF NOT EXISTS `ip_tabmegamenu_category` (
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

--
-- Dumping data for table `ip_tabmegamenu_category`
--

INSERT INTO `ip_tabmegamenu_category` (`category_id`, `catalog_id`, `title`, `url`, `column`, `position`, `align_category`, `align_content`, `content_top`, `content_bottom`, `from_time`, `to_time`, `is_active`) VALUES
(2, 13, 'Electronics', '#', 3, 5, 'left', 'left', 0x3c68323e3220636f6c756d6e732063617465676f7279206c61796f75743c2f68323e0d0a3c703e596f752063616e20636f6d706c6574656c79206368616e6765206d656e75206f7220796f752063616e206c656176652069742061732069732c2074686973206d656e7520646f6573206e6f74206769766520796f7520616e792074726f75626c652e20416c6c207061727473206f66204d6567614d656e752061726520636f6d706c6574656c79206368616e676561626c6520696e207468652061646d696e6973747261746976652073656374696f6e2c20796f752063616e20616c736f206368616e6765206e616d6573206f722075726c206c696e6b732e2054686973206d656e75206973207265616c6c7920636f6e76696e69656e742e3c2f703e, NULL, '2009-11-06 10:46:36', '2011-03-12 02:45:00', 1),
(5, 10, 'Furniture', '#', 2, 2, 'left', 'left', 0x3c64697620636c6173733d22636f6c5f32223e0d0a3c68323e3220636f6c756d6e732063617465676f727920636f6e74656e743c2f68323e0d0a3c2f6469763e, '', '2011-02-27 16:47:02', NULL, 1),
(6, 18, 'Apparel', '#', 1, 12, 'left', 'left', 0x3c68323e3120436f6c756d6e3c2f68323e, 0x3c703e4353533320616e642043726f73732042726f7773657220537570706f72742e3c2f703e, '2001-03-12 16:52:09', '2016-03-31 16:52:09', 1),
(7, 3, 'All catalog example', '/', 5, 1, 'left', 'left', NULL, 0x3c64697620636c6173733d22636f6c5f35223e0d0a3c68323e5468697320697320616e206578616d706c65206f662020726f6f742077697468203520636f6c756d6e733c2f68323e0d0a3c2f6469763e0d0a3c64697620636c6173733d22636f6c5f31223e0d0a3c7020636c6173733d22626c61636b5f626f78223e43726561742065646966666572656e7420636f6e74656e7420626c6c6f636b7320616e6420646973706c6179207468656d207769746820796f7520435353207374796c65733c2f703e0d0a3c2f6469763e0d0a3c64697620636c6173733d22636f6c5f31223e0d0a3c703e4372656174652062656175746966756c20626c6f636b732077697468206d6167656e746f2d667269656e646c7920696e74657266616365203c7374726f6e673e6174206261636b656e643c2f7374726f6e673e3c2f703e0d0a3c2f6469763e0d0a3c64697620636c6173733d22636f6c5f31223e3c696d67207372633d222f6d656469612f69705f7461626d6567616d656e752f626573745f73656c6c696e675f696d6730322e706e672220616c743d22222077696474683d22393522206865696768743d22393522202f3e3c2f6469763e0d0a3c703e7b7b626c6f636b20747970653d22636f72652f74656d706c61746522206e616d653d22636f6e74616374466f726d2220666f726d5f616374696f6e3d222f636f6e74616374732f696e6465782f706f7374222074656d706c6174653d22636f6e74616374732f666f726d2e7068746d6c227d7d3c2f703e0d0a3c6872202f3e, '2011-03-13 23:18:23', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ip_tabmegamenu_category_store`
--

CREATE TABLE IF NOT EXISTS `ip_tabmegamenu_category_store` (
  `category_id` smallint(6) unsigned DEFAULT NULL,
  `store_id` smallint(6) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ip_tabmegamenu_category_store`
--

INSERT INTO `ip_tabmegamenu_category_store` (`category_id`, `store_id`) VALUES
(5, 0),
(6, 0),
(2, 0),
(7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ip_tabmegamenu_item`
--

CREATE TABLE IF NOT EXISTS `ip_tabmegamenu_item` (
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

--
-- Dumping data for table `ip_tabmegamenu_item`
--

INSERT INTO `ip_tabmegamenu_item` (`item_id`, `title`, `url`, `column`, `align_item`, `align_content`, `position`, `content`, `from_time`, `to_time`, `is_active`, `columnsize`) VALUES
(11, '5 columns [right]', '#', 5, 'right', 'right', 1, '<p><span style="color: #ff6600;">Li Europan lingues es membres del sam familie.</span> Lor separat existentie es un myth. Por scientie, musica, sport etc, litot Europa usa li sam vocabular. Li lingues differe<span style="background-color: #ffff00;"> solmen in li grammatica, li pronunciation e li plu commun vocabules. Omnicos directe al desirabilite de un nov lingua franc</span>a: On refusa continuar payar custosi traductores. At solmen va esser necessi far uniform grammatica, pronunciation e plu sommun paroles. Ma quande<span style="background-color: #888888;"> lingues coalesce, li grammatica del resultant lingue</span> es plu simplic e regulari quam ti del coalescent lingues. Li nov lingua franca va esser plu simplic e regulari quam li existent Europan lingues. It va esser tam simplic qua<span style="background-color: #00ff00;">m Occidental in fact, it va esser Occidental. A un Angleso it va semblar un simplificat Angles, quam un skeptic Cambridge amico dit me que Occidenta</span>l es.</p>', '2011-09-23 22:13:46', NULL, 1, 0),
(12, '3 columns [left]', '#', 3, 'left', 'left', 3, '<p><strong>Magento</strong>&nbsp;is an&nbsp;<a title="Open source" href="http://en.wikipedia.org/wiki/Open_source">open source</a>&nbsp;based&nbsp;<a class="mw-redirect" title="Ecommerce" href="http://en.wikipedia.org/wiki/Ecommerce">ecommerce</a>&nbsp;web application that was launched on March 31, 2008. It was developed by Varien (now Magento Inc) with help from the programmers within the open source community but is owned solely by&nbsp;<a class="external text" rel="nofollow" href="http://www.magentocommerce.com/">Magento Inc.</a>. Magento was built using the&nbsp;<a title="Zend Framework" href="http://en.wikipedia.org/wiki/Zend_Framework">Zend Framework</a>.&nbsp;It uses the&nbsp;<a title="Entity-attribute-value model" href="http://en.wikipedia.org/wiki/Entity-attribute-value_model">Entity-attribute-value</a>&nbsp;(EAV) database model to store data. The Magento Community Edition is the only free version of Magento available. All other versions of Magento are not free.</p>', '2011-09-23 22:14:44', NULL, 1, 0),
(13, '2 column [left]', '#', 2, 'left', 'left', 1, '<div>\r\n<p><strong>Magento</strong>&nbsp;is an&nbsp;<a title="Open source" href="http://en.wikipedia.org/wiki/Open_source">open source</a>&nbsp;based&nbsp;<a class="mw-redirect" title="Ecommerce" href="http://en.wikipedia.org/wiki/Ecommerce">ecommerce</a>&nbsp;web application that was launched on March 31, 2008. It was developed by Varien (now Magento Inc) with help from the programmers within the open source community but is owned solely by&nbsp;<a class="external text" rel="nofollow" href="http://www.magentocommerce.com/">Magento Inc.</a>. Magento was built using the&nbsp;<a title="Zend Framework" href="http://en.wikipedia.org/wiki/Zend_Framework">Zend Framework</a>.&nbsp;It uses the&nbsp;<a title="Entity-attribute-value model" href="http://en.wikipedia.org/wiki/Entity-attribute-value_model">Entity-attribute-value</a>&nbsp;(EAV) database model to store data. The Magento Community Edition is the only free version of Magento available. All other versions of Magento are not free.</p>\r\n</div>', '2011-09-24 10:36:38', NULL, 1, 0),
(14, '2 column [left]', '#', 2, 'left', 'left', 1, '<div>\r\n<p><strong>Magento</strong>&nbsp;is an&nbsp;<a title="Open source" href="http://en.wikipedia.org/wiki/Open_source">open source</a>&nbsp;based&nbsp;<a class="mw-redirect" title="Ecommerce" href="http://en.wikipedia.org/wiki/Ecommerce">ecommerce</a>&nbsp;web application that was launched on March 31, 2008. It was developed by Varien (now Magento Inc) with help from the programmers within the open source community but is owned solely by&nbsp;<a class="external text" rel="nofollow" href="http://www.magentocommerce.com/">Magento Inc.</a>. Magento was built using the&nbsp;<a title="Zend Framework" href="http://en.wikipedia.org/wiki/Zend_Framework">Zend Framework</a>.&nbsp;It uses the&nbsp;<a title="Entity-attribute-value model" href="http://en.wikipedia.org/wiki/Entity-attribute-value_model">Entity-attribute-value</a>&nbsp;(EAV) database model to store data. The Magento Community Edition is the only free version of Magento available. All other versions of Magento are not free.</p>\r\n</div>', '2011-09-24 10:37:21', NULL, 1, 0),
(15, '3 column [left]', '#', 3, 'left', 'left', 1, '<div>\r\n<p><strong>Magento</strong>&nbsp;is an&nbsp;<a title="Open source" href="http://en.wikipedia.org/wiki/Open_source">open source</a>&nbsp;based&nbsp;<a class="mw-redirect" title="Ecommerce" href="http://en.wikipedia.org/wiki/Ecommerce">ecommerce</a>&nbsp;web application that was launched on March 31, 2008. It was developed by Varien (now Magento Inc) with help from the programmers within the open source community but is owned solely by&nbsp;<a class="external text" rel="nofollow" href="http://www.magentocommerce.com/">Magento Inc.</a>. Magento was built using the&nbsp;<a title="Zend Framework" href="http://en.wikipedia.org/wiki/Zend_Framework">Zend Framework</a>.&nbsp;It uses the&nbsp;<a title="Entity-attribute-value model" href="http://en.wikipedia.org/wiki/Entity-attribute-value_model">Entity-attribute-value</a>&nbsp;(EAV) database model to store data. The Magento Community Edition is the only free version of Magento available. All other versions of Magento are not free.</p>\r\n</div>', '2011-09-24 10:38:17', NULL, 1, 0),
(16, '4 column [left]', '#', 4, 'left', 'left', 1, '<div>\r\n<p><strong>Magento</strong>&nbsp;is an&nbsp;<a title="Open source" href="http://en.wikipedia.org/wiki/Open_source">open source</a>&nbsp;based&nbsp;<a class="mw-redirect" title="Ecommerce" href="http://en.wikipedia.org/wiki/Ecommerce">ecommerce</a>&nbsp;web application that was launched on March 31, 2008. It was developed by Varien (now Magento Inc) with help from the programmers within the open source community but is owned solely by&nbsp;<a class="external text" rel="nofollow" href="http://www.magentocommerce.com/">Magento Inc.</a>. Magento was built using the&nbsp;<a title="Zend Framework" href="http://en.wikipedia.org/wiki/Zend_Framework">Zend Framework</a>.&nbsp;It uses the&nbsp;<a title="Entity-attribute-value model" href="http://en.wikipedia.org/wiki/Entity-attribute-value_model">Entity-attribute-value</a>&nbsp;(EAV) database model to store data. The Magento Community Edition is the only free version of Magento available. All other versions of Magento are not free.</p>\r\n</div>', '2011-09-24 10:39:39', NULL, 1, 0),
(17, '5 column [left]', '#', 5, 'right', 'right', 1, '<div>\r\n<h3>Product Features &amp; Benefits</h3>\r\n<p><strong>Seamless Storefront Integration</strong>&nbsp;<br />With the new Magento-mobile admin, you&rsquo;ll bring the functional powerhouse of Magento eCommerce to your mobile commerce channel, including full integration with your store&rsquo;s catalog, checkout, inventory, reporting, and much more!</p>\r\n<p><strong>Manage Multiple Devices</strong>&nbsp;<br />Easily manage multiple devices with a single installation. Coming later this year, easily extend your mobile presence to the iPad and Android devices.</p>\r\n<p><strong>Hassle Free Submissions</strong>&nbsp;<br />Supporting a native app can be time consuming and tedious, so we manage the submission &amp; support lifecycle for one low monthly fee. We manage the complexity of mobile apps so you can focus on running your business!</p>\r\n<p><strong>Fully Customizable</strong>&nbsp;<br />Deploy new device-specific features and branded themes with just a few clicks. Quickly update the colors and appearance of your app with the new Magento mobile admin, even after customers have downloaded your app.</p>\r\n<p><strong>Engage Your Customers</strong>&nbsp;<br />If you want to build deeper relationships with your most profitable customers, smartphones are the way to do it. From geo-targeted push notifications to immersive native experiences, mobile apps unlock new opportunities that will take your business to the next level!</p>\r\n</div>\r\n<hr />\r\n<p>EXAMPLE OF MAGENTO WIDGET: { {block type="core/template" name="contactForm" form_action="/contacts/index/post" template="contacts/form.phtml"} }</p>\r\n<p>{{block type="core/template" name="contactForm" form_action="/contacts/index/post" template="contacts/form.phtml"}}</p>\r\n<hr />', '2011-09-24 10:42:25', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ip_tabmegamenu_item_store`
--

CREATE TABLE IF NOT EXISTS `ip_tabmegamenu_item_store` (
  `item_id` smallint(6) unsigned DEFAULT NULL,
  `store_id` smallint(6) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ip_tabmegamenu_item_store`
--

INSERT INTO `ip_tabmegamenu_item_store` (`item_id`, `store_id`) VALUES
(13, 0),
(14, 0),
(15, 0),
(16, 0),
(12, 0),
(11, 0),
(17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ip_tabmegamenu_tab`
--

CREATE TABLE IF NOT EXISTS `ip_tabmegamenu_tab` (
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

--
-- Dumping data for table `ip_tabmegamenu_tab`
--

INSERT INTO `ip_tabmegamenu_tab` (`tab_id`, `title`, `url`, `type`, `position`, `align_tab`, `css_style`, `css_class`, `css_style_content`, `css_class_content`, `from_time`, `to_time`, `is_active`) VALUES
(17, 'First tab', '#', 1, 1, 'left', '', 'extra-class1', '', 'extra-class1-content', '2011-10-11 11:43:12', NULL, 1),
(18, 'Second tab', '#', 1, 2, 'left', '', 'extra-class1', '', 'extra-class1-content', '2011-11-10 11:43:29', NULL, 1),
(19, 'Third tab', '#', 1, 3, 'left', '', 'extra-class1', '', 'extra-class1-content', '2011-11-10 11:43:54', NULL, 1),
(20, 'visit magazento.com', 'http://www.magazento.com', 0, 7, 'right', '', '', '', '', '2011-11-14 22:23:22', NULL, 1),
(21, 'visit EcommerceOffice.com', 'http://www.ecommerceoffice.com', 0, 6, 'left', '', '', '', '', '2011-11-14 22:37:04', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ip_tabmegamenu_tab_category`
--

CREATE TABLE IF NOT EXISTS `ip_tabmegamenu_tab_category` (
  `tab_id` smallint(6) unsigned DEFAULT NULL,
  `category_id` smallint(6) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ip_tabmegamenu_tab_category`
--

INSERT INTO `ip_tabmegamenu_tab_category` (`tab_id`, `category_id`) VALUES
(17, 7),
(18, 7),
(18, 5),
(18, 2),
(18, 6),
(19, 7);

-- --------------------------------------------------------

--
-- Table structure for table `ip_tabmegamenu_tab_item`
--

CREATE TABLE IF NOT EXISTS `ip_tabmegamenu_tab_item` (
  `tab_id` smallint(6) unsigned DEFAULT NULL,
  `item_id` smallint(6) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ip_tabmegamenu_tab_item`
--

INSERT INTO `ip_tabmegamenu_tab_item` (`tab_id`, `item_id`) VALUES
(17, 11),
(17, 12),
(17, 13),
(17, 17),
(18, 11),
(18, 12),
(18, 13),
(19, 14);

-- --------------------------------------------------------

--
-- Table structure for table `ip_tabmegamenu_tab_store`
--

CREATE TABLE IF NOT EXISTS `ip_tabmegamenu_tab_store` (
  `tab_id` smallint(6) unsigned DEFAULT NULL,
  `store_id` smallint(6) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ip_tabmegamenu_tab_store`
--

INSERT INTO `ip_tabmegamenu_tab_store` (`tab_id`, `store_id`) VALUES
(17, 0),
(18, 0),
(19, 0),
(21, 0),
(20, 0);
