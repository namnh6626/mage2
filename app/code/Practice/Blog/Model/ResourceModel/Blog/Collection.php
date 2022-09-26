<?php

namespace Practice\Blog\Model\ResourceModel\Blog;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init('Practice\Blog\Model\Blog', 'Practice\Blog\Model\ResourceModel\Blog');
    }

    public function joinAllBlogInfo()
    {
        $this->getSelect()
            ->join('blog_attribute_value', 'blog_attribute_value.blog_entity_id = blog_entity.blog_entity_id', '*')
            ->join('blog_attribute', 'blog_attribute.blog_attribute_id = blog_attribute_value.blog_attribute_id', '*');
    }
}
