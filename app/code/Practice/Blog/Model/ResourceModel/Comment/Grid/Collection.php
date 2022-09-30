<?php

namespace Practice\Blog\Model\ResourceModel\Comment\Grid;

use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Psr\Log\LoggerInterface as Logger;

class Collection extends SearchResult
{
    protected $_idFieldName = 'comment_entity_id';

    public function __construct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,
        $mainTable = 'comment_entity',
        $resourceModel = 'Practice\Blog\Model\ResourceModel\Comment',
        $identifierName = null,
        $connectionName = null
    ) {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $resourceModel, $identifierName, $connectionName);
    }

    /**
     * @return Collection|void
     */
    protected function _initSelect()
    {
        parent::_initSelect();

        $this->getSelect()
        ->joinLeft(
            'blog_entity',
            'main_table.blog_entity_id = blog_entity.blog_entity_id',
            ['title']
        )
        ->joinLeft(
            'customer_entity',
            'main_table.customer_id = customer_entity.entity_id',
            ['*']
        )
        ->joinLeft(
            'comment_status',
            'main_table.comment_status_id = comment_status.comment_status_id',
            ['*']
        );

    }
}
