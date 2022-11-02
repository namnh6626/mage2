<?php

namespace Practice\Blog\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;
use Magento\Customer\Model\SessionFactory;

class CustomInfo implements SectionSourceInterface

{
    protected $session;

    public function __construct(

        SessionFactory $customerSession

    ) {
        $this->session = $customerSession->create();
    }

    public function getSectionData()
    {
        return [
            'data' => "Customer info data"
        ];
    }
}
