<?php

namespace Practice\Blog\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface BlogInterface extends ExtensibleDataInterface
{
    const BLOG_ENTITY_ID = 'blog_entity_id';
    const BLOG_CONTENT = 'content';
    const BLOG_TITLE = 'title';
    const BLOG_USER_ID = 'user_id';
    const BLOG_AVATAR = 'blog_avatar_link';
    const BLOG_CREATED_AT = 'created_at';


    public function getBlogEntityId(): int;

    public function setBlogEntityId($id);

    public function getTitle();

    public function setTitle($title);

    public function getContent();

    public function setContent($content);

    public function getUserId(): int;

    public function setUserId($userId);

    public function getBlogAvatarLink();

    public function setBlogAvatarLink($link);

}
