<?php

namespace Practice\Blog\Api;
use Practice\Blog\Api\Data\BlogCategoryInterface;

interface BlogCategoryRepositoryInterface {
    public function save(BlogCategoryInterface $blogCategoryInterface);

    public function getList(BlogCategoryInterface $blogCategoryInterface);


}
