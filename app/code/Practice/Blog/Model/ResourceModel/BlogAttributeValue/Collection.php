<?php

namespace Practice\Blog\Model\ResourceModel\BlogAttributeValue;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection{
    public function _construct(){
        $this->_init('Practice\Blog\Model\BlogAttributeValue', 'Practice\Blog\Model\ResourceModel\BlogAttributeValue');
    }
}
