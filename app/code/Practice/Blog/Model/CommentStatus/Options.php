<?php

namespace Practice\Blog\Model\CommentStatus;

use Magento\Framework\Option\ArrayInterface;
use Practice\Blog\Model\ResourceModel\CommentStatus\CollectionFactory;


class Options implements ArrayInterface{
    protected $commentStatusCollection;
    public function __construct(CollectionFactory $commentStatusCollection)
    {
        $this->commentStatusCollection = $commentStatusCollection;
    }

    public function toOptionArray()
    {
        $collection = $this->commentStatusCollection->create()->getData();
        $commentStatusArray = [];
        foreach($collection as $status){
            $commentStatusArray[] = array(
                'label'=>__($status['comment_status_name']),
                'value'=> $status['comment_status_id']
            );
        }
        return $commentStatusArray;

    }
}
