<?php

namespace Practice\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class BlogNotification extends AbstractDb
{
    public function _construct()
    {
        $this->_init('blog_notification', 'blog_notification_id');
    }
}
