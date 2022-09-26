<?php

namespace Practice\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class BlogAttributeValue extends AbstractDb
{
    public function _construct()
    {
        $this->_init('blog_attribute_value', 'blog_attribute_value_id');
    }
}
