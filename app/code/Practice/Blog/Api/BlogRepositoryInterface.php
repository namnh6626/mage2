<?php
namespace Practice\Blog\Api;

use Practice\Blog\Api\Data\BlogInterface;

interface BlogRepositoryInterface{

    public function save(BlogInterface $blogInterface);

    public function getList(BlogInterface $blogInterface);

    public function getBlogContentById($id);

}
