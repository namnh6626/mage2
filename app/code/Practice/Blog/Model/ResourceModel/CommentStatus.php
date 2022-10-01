<?php

namespace Practice\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CommentStatus extends AbstractDb
{
    public function _construct()
    {
        $this->_init('comment_status', 'comment_status_id');
    }
}
