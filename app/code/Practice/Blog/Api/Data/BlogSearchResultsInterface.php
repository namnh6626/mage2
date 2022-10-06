<?php
namespace Practice\Blog\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * @api
 */
interface BlogSearchResultsInterface extends SearchResultsInterface
{

    public function getItems();


    public function setItems(array $items);
}
