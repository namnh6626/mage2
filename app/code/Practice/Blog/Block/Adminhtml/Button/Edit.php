<?php

namespace Practice\Blog\Block\Adminhtml\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Edit implements ButtonProviderInterface
{

    public function getButtonData()
    {

        return [

            'label' => __('Update Blog'),

            'class' => 'save primary',

            'data_attribute' => [

                'mage-init' => ['button' => ['event' => 'save']],

                'form-role' => 'save',

            ],

            'sort_order' => 90,

        ];
    }
}
