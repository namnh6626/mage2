<?php

namespace Practice\Blog\Model\ResourceModel\BlogCategoryValue;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init('Practice\Blog\Model\BlogCategoryValue', 'Practice\Blog\Model\ResourceModel\BlogCategoryValue');
    }
}
