<?php
namespace Practice\Blog\Block\Adminhtml\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Edit implements ButtonProviderInterface {
    public function getButtonData()
    {
        return [

            'label' => __('Edit Blog'),

            'class' => 'edit primary',

            'data_attribute' => [

                'mage-init' => ['button' => ['event' => 'edit']],

                'form-role' => 'edit',

            ],

            'sort_order' => 90,

        ];
    }
}
