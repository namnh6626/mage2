<?php

namespace Practice\Blog\Model\ResourceModel\Blog;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Practice\Blog\Model\Blog', 'Practice\Blog\Model\ResourceModel\Blog');
    }


}
