<?php

$installer = $this;
$installer->startSetup();
$installer->run("

DROP TABLE IF EXISTS `{$this->getTable('sofiaslider/slides')}`;
CREATE TABLE `{$this->getTable('sofiaslider/slides')}` (
  `slide_id` int(11) unsigned NOT NULL auto_increment,
  `slide_align` ENUM('left', 'right', 'center'),
  `slide_title` text NOT NULL default '',
  `slide_title_color` text NOT NULL default '',
  `slide_sub_title` text NOT NULL default '',
  `slide_sub_title_color` text NOT NULL default '',  
  `slide_text` text NOT NULL default '',
  `slide_text_color` text NOT NULL default '',
  `slide_button` text NOT NULL default '',
  `slide_width` varchar(8) NOT NULL default '',
  `slide_link` varchar(255) NOT NULL default '',
  `image` varchar(255) NOT NULL default '',
  `status` smallint(6) NOT NULL default '0',
  `sort_order` smallint(6) NOT NULL default '0',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`slide_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `{$this->getTable('sofiaslider/slides')}` (`slide_id`, `slide_align`, `slide_title`, `slide_title_color`, `slide_sub_title`, `slide_sub_title_color`, `slide_text`, `slide_text_color`, `slide_button`, `slide_link`, `image`, `status`, `sort_order`, `created_time`, `update_time`) VALUES (1, 'right', 'LOREM IPSUM DOLOR SIT AMEN', '#fb489e','Neque porro quisquam est qui dolore', '#fb489e', 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut', '#0d0d0d', 'Shop Now', '//sl1', 'frexy/sofia/sofiaslider/banner1.jpg', 1, 10, NOW(), NOW() );
INSERT INTO `{$this->getTable('sofiaslider/slides')}` (`slide_id`, `slide_align`, `slide_title`, `slide_title_color`, `slide_sub_title`, `slide_sub_title_color`, `slide_text`, `slide_text_color`, `slide_button`, `slide_link`, `image`, `status`, `sort_order`, `created_time`, `update_time`) VALUES (2, 'left', 'LOREM IPSUM DOLOR SIT AMEN', '#fb489e','Neque porro quisquam est qui dolore', '#fb489e', 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut', '#0d0d0d', 'Shop Now', '//sl1', 'frexy/sofia/sofiaslider/banner2.jpg', 1, 10, NOW(), NOW() );
INSERT INTO `{$this->getTable('sofiaslider/slides')}` (`slide_id`, `slide_align`, `slide_title`, `slide_title_color`, `slide_sub_title`, `slide_sub_title_color`, `slide_text`, `slide_text_color`, `slide_button`, `slide_link`, `image`, `status`, `sort_order`, `created_time`, `update_time`) VALUES (3, 'center', 'LOREM IPSUM DOLOR SIT AMEN', '#fb489e','Neque porro quisquam est qui dolore', '#fb489e', 'Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut', '#0d0d0d', 'Shop Now', '//sl1', 'frexy/sofia/sofiaslider/banner3.jpg', 1, 10, NOW(), NOW() );

");

/**
 * Drop 'slides_store' table
 */
$conn = $installer->getConnection();
$conn->dropTable($installer->getTable('sofiaslider/slides_store'));

/**
 * Create table for stores
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('sofiaslider/slides_store'))
    ->addColumn('slide_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
    'nullable'  => false,
    'primary'   => true,
), 'Slide ID')
    ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
    'unsigned'  => true,
    'nullable'  => false,
    'primary'   => true,
), 'Store ID')
    ->addIndex($installer->getIdxName('sofiaslider/slides_store', array('store_id')),
    array('store_id'))
    ->addForeignKey($installer->getFkName('sofiaslider/slides_store', 'slide_id', 'sofiaslider/slides', 'slide_id'),
    'slide_id', $installer->getTable('sofiaslider/slides'), 'slide_id',
    Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addForeignKey($installer->getFkName('sofiaslider/slides_store', 'store_id', 'core/store', 'store_id'),
    'store_id', $installer->getTable('core/store'), 'store_id',
    Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Slide To Store Linkage Table');
$installer->getConnection()->createTable($table);

/**
 * Assign 'all store views' to existing slides
 */
$installer->run("INSERT INTO {$this->getTable('sofiaslider/slides_store')} (`slide_id`, `store_id`) SELECT `slide_id`, 0 FROM {$this->getTable('sofiaslider/slides')};");
$installer->endSetup();