<?php

namespace Practice\Blog\Model;

use Magento\Framework\Model\AbstractModel;

class BlogCategory extends AbstractModel
{
    public function _construct()
    {
        $this->_init('Practice\Blog\Model\ResourceModel\BlogCategory');
    }
}
