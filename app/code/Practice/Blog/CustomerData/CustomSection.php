<?php

namespace Practice\Blog\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;

class CustomSection implements SectionSourceInterface
{
    public function getSectionData()
    {
        return [
            'customdata' => "put here your dynamic data",
        ];
    }
}
