<?php 
class Yli_Fulltext_Model_Resource_Helper_Mysql4 extends Mage_CatalogSearch_Model_Resource_Helper_Mysql4
{
	 /**
     * Join information for usin full text search
     *
     * @param  Varien_Db_Select $select
     * @return Varien_Db_Select $select
     */
    public function chooseFulltext($table, $alias, $select)
    {
        $field = new Zend_Db_Expr('MATCH ('.$alias.'.data_index) AGAINST (:query IN NATURAL LANGUAGE MODE)');
        $select->columns(array('relevance' => $field));
        return $field;
    }
}