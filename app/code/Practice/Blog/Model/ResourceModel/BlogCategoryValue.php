<?php

namespace Practice\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class BlogCategoryValue extends AbstractDb
{
    public function _construct()
    {
        $this->_init('blog_category_value', 'blog_entity_id');
    }
}
