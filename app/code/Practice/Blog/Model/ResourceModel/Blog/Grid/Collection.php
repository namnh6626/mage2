<?php

namespace Practice\Blog\Model\ResourceModel\Blog\Grid;

use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;
use Psr\Log\LoggerInterface as Logger;

class Collection extends SearchResult
{
    protected $_idFieldName = 'blog_entity_id';

    public function __construct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,
        $mainTable = 'blog_entity',
        $resourceModel = 'Practice\Blog\Model\ResourceModel\Blog',
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
            'blog_status',
            'main_table.blog_status_id = blog_status.blog_status_id',
            ['*']
        )
        ->joinLeft(
            'admin_user',
            'main_table.user_id = admin_user.user_id',
            ['*']
        );

    }
}
