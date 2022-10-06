<?php

namespace Practice\Blog\Api;

use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaInterface;
use Practice\Blog\Api\Data\BlogInterface;

interface BlogRepositoryInterface
{
    public function save(BlogInterface $blogInterface);

    public function getList(SearchCriteriaInterface $searchCriteria);

    public function getBlogContentById($blogId);

    public function getBlogCategories($blogId);

    public function getBlogComments($blogId, $customerId);

    public function getById($blogId);

    public function update(BlogInterface $blogInterface, $blog);
}
