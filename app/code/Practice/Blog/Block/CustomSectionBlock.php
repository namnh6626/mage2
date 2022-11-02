<?php

namespace Practice\Blog\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Practice\Blog\Api\Data\CommentInterface;
use Practice\Blog\Model\ResourceModel\CommentRepository;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\PageCache\Model\Cache\Type as CacheType;

class CustomSectionBlock extends Template implements IdentityInterface
{
    protected $commentInterface;
    protected $commentRepository;

    public function __construct(
        Context $context,
        array $data = [],
        CommentInterface $commentInterface,
        CommentRepository $commentRepository
    ) {
        parent::__construct($context, $data);

        $this->commentInterface = $commentInterface;
        $this->commentRepository = $commentRepository;
    }

    public function getIdentities()
    {
        return [CacheType::TYPE_IDENTIFIER];
    }
}
