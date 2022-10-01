<?php

namespace Practice\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class BlogCategory extends AbstractDb
{
    public function _construct()
    {
        $this->_init('blog_category', 'blog_category_id');
    }
}
