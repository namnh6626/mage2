<?php

namespace Practice\Blog\Model\ResourceModel\BlogCategory;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init('Practice\Blog\Model\BlogCategory', 'Practice\Blog\Model\ResourceModel\BlogCategory');
    }
}
