<?php
namespace Practice\Blog\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface BlogCategoryInterface extends ExtensibleDataInterface {
    CONST BLOG_CATEGORY_ID = 'blog_category_id';
    CONST BLOG_CATEGORY_NAME = 'blog_category_name';

    public function getBlogCategoryName();

    public function setBlogCategoryName($name);
}
