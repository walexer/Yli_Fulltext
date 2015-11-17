<?php
/** @var Mage_Core_Model_Resource_Setup */
$installer = $this;

Mage::getConfig()->saveConfig('catalog/search/search_type', 2);
$config = Mage::getSingleton('core/resource')->getConnection()->getConfig();
$dbname = $config['dbname'];
$installer->run("
	ALTER TABLE `catalogsearch_fulltext` ENGINE=InnoDB;
	ALTER TABLE `catalogsearch_fulltext` COLLATE='utf8mb4_general_ci';
  ALTER TABLE `catalogsearch_fulltext` DROP INDEX `FTI_CATALOGSEARCH_FULLTEXT_DATA_INDEX`;
  ALTER TABLE `catalogsearch_fulltext` ADD FULLTEXT INDEX `FTI_CATALOGSEARCH_FULLTEXT_DATA_INDEX` (`data_index`) WITH PARSER ngram;
	SET GLOBAL innodb_ft_aux_table='$dbname/catalogsearch_fulltext';
");
$installer->endSetup();