<?php

namespace Practice\Blog\Api;

use Practice\Blog\Api\Data\BlogNotificationInterface;

interface BlogNotificationRepositoryInterface
{
    public function save(BlogNotificationInterface $blogNotificationInterface);
}
