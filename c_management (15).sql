-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2016 at 10:54 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `c_management`
--
CREATE DATABASE IF NOT EXISTS `c_management` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `c_management`;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `ref` varchar(100) NOT NULL,
  `desig` varchar(255) NOT NULL,
  `tva` int(2) NOT NULL,
  `supplier_id` int(20) NOT NULL,
  `category_id` int(20) NOT NULL DEFAULT '0',
  `unit_id` int(20) NOT NULL DEFAULT '0',
  `thumb` varchar(255) NOT NULL DEFAULT 'no_thumb.jpg',
  `created_at` datetime NOT NULL ,
  `updated_at` datetime NOT NULL ,
  `created_by` int(20) NOT NULL,
  `updated_by` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `ref`, `desig`, `tva`, `supplier_id`, `category_id`, `unit_id`, `thumb`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES


-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(0, 'غير مصنف'),
(1, 'معدات  معلوماتية'),
(2, 'مكاتب'),
(3, '&lt;script&gt;alert(&quot;hello&quot;);&lt;/script&gt;'),
(4, 'حذف	&lt;script&gt;alert(&quot;hello&quot;);&lt;/script&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL ,
  `updated_at` datetime NOT NULL ,
  `created_by` int(11) NOT NULL DEFAULT '1',
  `updated_by` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `tel`, `email`, `zip_code`, `city`, `address`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(4, 'said hamri', '', 'ssdd@dd.com', '565656456', 'etetzete', 'zetzetzete', '2016-10-14 18:44:30', '2016-10-14 18:44:30', 1, 1),
(7, 'khalid essaadani', '45458686', 'ssdd@dd.com', '455445', 'FGKLDFKL', '&pound;DFDFMLDFDFMLMO', '2016-10-14 18:46:01', '2016-12-22 21:42:36', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_forms_clt`
--

CREATE TABLE IF NOT EXISTS `delivery_forms_clt` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `num` varchar(100) NOT NULL,
  `dt` varchar(10) DEFAULT NULL,
  `discr` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `client_id` int(20) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL ,
  `updated_at` datetime NOT NULL ,
  `created_by` int(20) NOT NULL DEFAULT '1',
  `updated_by` int(20) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `delivery_forms_clt`
--

INSERT INTO `delivery_forms_clt` (`id`, `num`, `dt`, `discr`, `subject`, `client_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(5, '1', '22-12-2016', '', '', 4, '2016-12-22 21:40:36', '2016-12-22 21:40:36', 1, 1),
(6, '2', '22-12-2016', '', 'sesd', 7, '2016-12-22 21:43:23', '2016-12-22 21:43:23', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_forms_clt_arts`
--

CREATE TABLE IF NOT EXISTS `delivery_forms_clt_arts` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `delivery_form_clt_id` int(20) NOT NULL DEFAULT '0',
  `art_id` int(20) NOT NULL,
  `qte` double NOT NULL,
  `price` double NOT NULL,
  `creatred_at` datetime NOT NULL ,
  `updated_at` datetime NOT NULL ,
  `created_by` int(20) NOT NULL DEFAULT '1',
  `updated_by` int(20) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=83 ;

--
-- Dumping data for table `delivery_forms_clt_arts`
--

INSERT INTO `delivery_forms_clt_arts` (`id`, `delivery_form_clt_id`, `art_id`, `qte`, `price`, `creatred_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(80, 5, 1, 10, 10, '2016-12-22 21:40:41', '2016-12-22 21:40:41', 1, 1),
(82, 6, 1, 1, 200, '2016-12-22 21:43:41', '2016-12-22 21:43:41', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_forms_supplier`
--

CREATE TABLE IF NOT EXISTS `delivery_forms_supplier` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `num` varchar(100) NOT NULL,
  `dt` varchar(10) DEFAULT NULL,
  `discr` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `supplier_id` int(20) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL ,
  `updated_at` datetime NOT NULL ,
  `created_by` int(20) NOT NULL DEFAULT '1',
  `updated_by` int(20) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `delivery_forms_supplier`
--

INSERT INTO `delivery_forms_supplier` (`id`, `num`, `dt`, `discr`, `subject`, `supplier_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(2, 'efzzefe', '27-12-2016', '', 'zrezerzefzef', 1, '2016-12-27 21:01:37', '2016-12-27 21:01:43', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_forms_supplier_arts`
--

CREATE TABLE IF NOT EXISTS `delivery_forms_supplier_arts` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `delivery_form_supplier_id` int(20) NOT NULL DEFAULT '0',
  `art_id` int(20) NOT NULL,
  `qte` double NOT NULL,
  `price` double NOT NULL,
  `creatred_at` datetime NOT NULL ,
  `updated_at` datetime NOT NULL ,
  `created_by` int(20) NOT NULL DEFAULT '1',
  `updated_by` int(20) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `delivery_forms_supplier_arts`
--

INSERT INTO `delivery_forms_supplier_arts` (`id`, `delivery_form_supplier_id`, `art_id`, `qte`, `price`, `creatred_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(2, 2, 1, 100, 12, '2016-12-27 21:04:00', '2016-12-27 21:04:00', 1, 1),
(4, 2, 8, 120, 12, '2016-12-27 21:08:32', '2016-12-27 21:08:32', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoices_clt`
--

CREATE TABLE IF NOT EXISTS `invoices_clt` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `num` varchar(100) NOT NULL,
  `dt` varchar(10) DEFAULT NULL,
  `discr` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `client_id` int(20) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL ,
  `updated_at` datetime NOT NULL ,
  `created_by` int(20) NOT NULL DEFAULT '1',
  `updated_by` int(20) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `invoices_clt`
--

INSERT INTO `invoices_clt` (`id`, `num`, `dt`, `discr`, `subject`, `client_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(9, '1', '22-12-2016', '', '', 4, '2016-12-22 21:40:55', '2016-12-22 21:40:55', 1, 1),
(10, '2', '22-12-2016', '', 'ddd', 4, '2016-12-22 21:41:57', '2016-12-22 21:41:57', 1, 1),
(11, '2', '22-12-2016', '', 'qsdqs', 7, '2016-12-22 21:44:00', '2016-12-22 21:44:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoices_clt_arts`
--

CREATE TABLE IF NOT EXISTS `invoices_clt_arts` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `invoice_clt_id` int(20) NOT NULL DEFAULT '0',
  `art_id` int(20) NOT NULL,
  `qte` double NOT NULL,
  `price` double NOT NULL,
  `creatred_at` datetime NOT NULL ,
  `updated_at` datetime NOT NULL ,
  `created_by` int(20) NOT NULL DEFAULT '1',
  `updated_by` int(20) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=140 ;

--
-- Dumping data for table `invoices_clt_arts`
--

INSERT INTO `invoices_clt_arts` (`id`, `invoice_clt_id`, `art_id`, `qte`, `price`, `creatred_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(135, 9, 1, 10, 10, '2016-12-22 21:41:00', '2016-12-25 12:01:06', 1, 1),
(136, 9, 8, 14, 20, '2016-12-22 21:41:00', '2016-12-22 21:41:00', 1, 1),
(137, 10, 1, 10, 10, '2016-12-22 21:42:03', '2016-12-22 21:42:03', 1, 1),
(138, 10, 8, 14, 20, '2016-12-22 21:42:03', '2016-12-22 21:42:03', 1, 1),
(139, 11, 1, 1, 200, '2016-12-22 21:44:06', '2016-12-22 21:44:06', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments_clt`
--

CREATE TABLE IF NOT EXISTS `payments_clt` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `client_id` int(20) NOT NULL,
  `invoice_id` int(20) NOT NULL,
  `amount` double NOT NULL,
  `p_method_id` int(20) NOT NULL,
  `p_ref` varchar(255) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL ,
  `updated_at` datetime NOT NULL ,
  `created_by` int(20) NOT NULL DEFAULT '1',
  `updated_by` int(20) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `payments_clt`
--

INSERT INTO `payments_clt` (`id`, `client_id`, `invoice_id`, `amount`, `p_method_id`, `p_ref`, `attachment`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(4, 4, 9, 100, 1, '', '', '2016-12-22 22:07:49', '2016-12-22 22:07:49', 1, 1),
(5, 4, 9, 200, 1, '', '', '2016-12-22 22:07:49', '2016-12-24 23:37:12', 1, 1),
(20, 7, 11, 100, 1, '', '', '2016-12-25 16:10:27', '2016-12-25 16:10:27', 1, 1),
(21, 7, 11, 120, 1, '', '', '2016-12-25 16:10:54', '2016-12-25 16:10:54', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE IF NOT EXISTS `payment_methods` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `pm_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `pm_name`) VALUES
(1, 'نقدي'),
(2, 'شيك'),
(3, 'تحويل بنكي');

-- --------------------------------------------------------

--
-- Table structure for table `prs_clt`
--

CREATE TABLE IF NOT EXISTS `prs_clt` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `num` varchar(100) NOT NULL,
  `dt` varchar(10) DEFAULT NULL,
  `discr` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `client_id` int(20) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL ,
  `updated_at` datetime NOT NULL ,
  `created_by` int(20) NOT NULL DEFAULT '1',
  `updated_by` int(20) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='prices request client' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `prs_clt`
--

INSERT INTO `prs_clt` (`id`, `num`, `dt`, `discr`, `subject`, `client_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(4, '1', '22-12-2016', '', 'my sub', 4, '2016-12-22 21:37:40', '2016-12-22 21:37:40', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `prs_clt_arts`
--

CREATE TABLE IF NOT EXISTS `prs_clt_arts` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `pr_clt_id` int(20) NOT NULL DEFAULT '0',
  `art_id` int(20) NOT NULL,
  `qte` double NOT NULL,
  `creatred_at` datetime NOT NULL ,
  `updated_at` datetime NOT NULL ,
  `created_by` int(20) NOT NULL DEFAULT '1',
  `updated_by` int(20) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `prs_clt_arts`
--

INSERT INTO `prs_clt_arts` (`id`, `pr_clt_id`, `art_id`, `qte`, `creatred_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(7, 4, 1, 10, '2016-12-22 21:37:52', '2016-12-22 21:37:52', 1, 1),
(8, 4, 8, 14, '2016-12-22 21:38:03', '2016-12-22 21:38:03', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders_clt`
--

CREATE TABLE IF NOT EXISTS `purchase_orders_clt` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `num` varchar(100) NOT NULL,
  `dt` varchar(10) DEFAULT NULL,
  `discr` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `client_id` int(20) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL ,
  `updated_at` datetime NOT NULL ,
  `created_by` int(20) NOT NULL DEFAULT '1',
  `updated_by` int(20) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `purchase_orders_clt`
--

INSERT INTO `purchase_orders_clt` (`id`, `num`, `dt`, `discr`, `subject`, `client_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(4, '1', '22-12-2016', '', '', 4, '2016-12-22 21:40:03', '2016-12-22 21:40:03', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders_clt_arts`
--

CREATE TABLE IF NOT EXISTS `purchase_orders_clt_arts` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `purchase_order_clt_id` int(20) NOT NULL DEFAULT '0',
  `art_id` int(20) NOT NULL,
  `qte` double NOT NULL,
  `price` double NOT NULL,
  `creatred_at` datetime NOT NULL ,
  `updated_at` datetime NOT NULL ,
  `created_by` int(20) NOT NULL DEFAULT '1',
  `updated_by` int(20) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `purchase_orders_clt_arts`
--

INSERT INTO `purchase_orders_clt_arts` (`id`, `purchase_order_clt_id`, `art_id`, `qte`, `price`, `creatred_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(66, 4, 1, 10, 10, '2016-12-22 21:40:07', '2016-12-22 21:40:07', 1, 1),
(67, 4, 8, 14, 20, '2016-12-22 21:40:07', '2016-12-22 21:40:07', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `quotations_clt`
--

CREATE TABLE IF NOT EXISTS `quotations_clt` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `num` varchar(100) NOT NULL,
  `dt` varchar(10) DEFAULT NULL,
  `discr` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `client_id` int(20) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL ,
  `updated_at` datetime NOT NULL ,
  `created_by` int(20) NOT NULL DEFAULT '1',
  `updated_by` int(20) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `quotations_clt`
--

INSERT INTO `quotations_clt` (`id`, `num`, `dt`, `discr`, `subject`, `client_id`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(6, '1', '22-12-2016', '', 'sd', 4, '2016-12-22 21:38:24', '2016-12-22 21:38:24', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `quotations_clt_arts`
--

CREATE TABLE IF NOT EXISTS `quotations_clt_arts` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `quotation_clt_id` int(20) NOT NULL DEFAULT '0',
  `art_id` int(20) NOT NULL,
  `qte` double NOT NULL,
  `price` double NOT NULL,
  `creatred_at` datetime NOT NULL ,
  `updated_at` datetime NOT NULL ,
  `created_by` int(20) NOT NULL DEFAULT '1',
  `updated_by` int(20) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `quotations_clt_arts`
--

INSERT INTO `quotations_clt_arts` (`id`, `quotation_clt_id`, `art_id`, `qte`, `price`, `creatred_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(75, 6, 1, 10, 10, '2016-12-22 21:38:32', '2016-12-22 21:38:52', 1, 1),
(76, 6, 8, 14, 20, '2016-12-22 21:38:32', '2016-12-22 21:39:16', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) NOT NULL,
  `show_clients` int(1) NOT NULL DEFAULT '0',
  `aed_clients` int(1) NOT NULL DEFAULT '0',
  `show_suppliers` int(1) NOT NULL DEFAULT '0',
  `aed_suppliers` int(1) NOT NULL DEFAULT '0',
  `show_sales` int(1) NOT NULL DEFAULT '0',
  `aed_sales` int(1) NOT NULL DEFAULT '0',
  `show_purchases` int(1) NOT NULL DEFAULT '0',
  `aed_purchases` int(11) NOT NULL DEFAULT '0',
  `show_articles` int(1) NOT NULL DEFAULT '0',
  `aed_articles` int(1) NOT NULL DEFAULT '0',
  `show_stock` int(1) NOT NULL DEFAULT '0',
  `show_users_roles` int(1) NOT NULL DEFAULT '0',
  `aed_users_roles` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `show_clients`, `aed_clients`, `show_suppliers`, `aed_suppliers`, `show_sales`, `aed_sales`, `show_purchases`, `aed_purchases`, `show_articles`, `aed_articles`, `show_stock`, `show_users_roles`, `aed_users_roles`) VALUES
(1, 'أدمن', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 'مستخدم عادي', 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 1, 0),
(3, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'مكلف بالمبيعات', 1, 1, 1, 0, 1, 1, 0, 0, 1, 0, 1, 0, 0),
(5, 'dffdff', 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `tel` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL ,
  `updated_at` datetime NOT NULL ,
  `created_by` int(11) NOT NULL DEFAULT '1',
  `updated_by` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `tel`, `email`, `zip_code`, `city`, `address`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'INFO TECH', '066556565656', 's.hamri@windowslive.com', '23000', 'Beni Mellal', '101,Hay fdkjdfkjdf, Beni Melall', '2016-03-08 22:13:23', '2016-03-08 22:13:23', 1, 1),
(3, 'said hamri', '4554545', 'ssdd@dd.com', '565656456', 'etetzete', 'zetzetzete', '2016-10-05 22:09:22', '2016-10-05 22:09:22', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tva`
--

CREATE TABLE IF NOT EXISTS `tva` (
  `tva` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tva`
--

INSERT INTO `tva` (`tva`) VALUES
(20),
(14),
(10),
(7);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `unit` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit`) VALUES
(1, 'U'),
(2, 'Kg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `function` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `role_id` int(20) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT '0.jpg',
  `created_at` datetime NOT NULL ,
  `updated_at` datetime NOT NULL ,
  `created_by` int(20) NOT NULL,
  `updated_by` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `email`, `fname`, `lname`, `function`, `phone`, `role_id`, `avatar`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 's.hamri@windowslive.com', 'Said', 'HAMRI', 'Admin', '', 1, '1.jpg', '2016-08-31 00:25:13', '2016-11-05 12:58:09', 1, 1),
(3, 'khalid', '94ca247fff5ad413788a1c8d8c80394a246dba1c', 's.hamri@windowslive.com', 'khalid', 'essaadani', 'dev', 'dfdpfl', 2, '0.jpg', '2016-08-31 00:43:58', '2016-09-06 21:40:54', 1, 1),
(4, 'errer', '8356c35003e02a509a7e5c466b9d22712891a1ce', 'erere@ffdf.com', 'dfd', 'df', '', '', 2, '0.jpg', '2016-09-06 21:57:49', '2016-09-06 21:57:49', 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
