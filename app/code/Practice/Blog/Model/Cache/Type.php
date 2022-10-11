<?php

namespace Practice\Blog\Model\Cache;

use Magento\Framework\Cache\Frontend\Decorator\TagScope;
use Magento\Framework\App\Cache\Type\FrontendPool;

class Type extends TagScope
{
    const TYPE_IDENTIFIER = 'blog_content';

    const CACHE_TAG = 'BLOG_CONTENT';

    public function __construct(FrontendPool $cacheFrontendPool)
    {
        parent::__construct($cacheFrontendPool->get(self::TYPE_IDENTIFIER), self::CACHE_TAG);
    }
}
