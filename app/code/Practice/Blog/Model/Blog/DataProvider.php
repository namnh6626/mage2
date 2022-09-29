<?php
namespace Practice\Blog\Model\Blog;

use Practice\Blog\Model\ResourceModel\Blog\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $blogCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $blogCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }


    public function getData()
    {
        if (isset($this->loadedData)) {

            return $this->loadedData;

        }

        $items = $this->collection->getItems();

        foreach ($items as $item) {

            $this->loadedData[$item->getId()] = $item->getData();

        }

        return $this->loadedData;
    }
}
