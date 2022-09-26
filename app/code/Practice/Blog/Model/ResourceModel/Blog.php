<?php

namespace Practice\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Blog extends AbstractDb
{
    public function _construct()
    {
        $this->_init('blog_entity', 'blog_entity_id');
    }


}
