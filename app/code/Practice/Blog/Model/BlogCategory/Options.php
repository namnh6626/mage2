<?php

namespace Practice\Blog\Model\BlogCategory;

use Magento\Framework\Option\ArrayInterface;
use Practice\Blog\Model\ResourceModel\BlogCategory\CollectionFactory;
use Magento\Framework\DataObject;


class Options implements ArrayInterface{
    protected $blogCategoryCollection;
    public function __construct(CollectionFactory $blogCategoryCollection)
    {
        $this->blogCategoryCollection = $blogCategoryCollection;
    }

    public function toOptionArray()
    {
        $collection = $this->blogCategoryCollection->create()->getData();
        $blogCategoryArray = [];
        foreach($collection as $category){
            $blogCategoryArray[] = array(
                'label'=>__($category['blog_category_name']),
                'value'=> $category['blog_category_id']
            );
        }
        return $blogCategoryArray;

    }
}
