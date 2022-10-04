<?php
namespace Practice\Blog\Api;

use Practice\Blog\Api\Data\CommentInterface;

interface CommentRepositoryInterface {
    public function save(CommentInterface $commentInterface);

    public function getList(CommentInterface $commentInterface);
}
