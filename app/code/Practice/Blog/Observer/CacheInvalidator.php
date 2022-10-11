<?php
namespace Practice\Blog\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\PageCache\Model\Config;
use Magento\Framework\App\Cache\TypeListInterface;
// use Magento\PageCache\Model\Cache\Type;
use Practice\Blog\Model\Cache\Type;

class CacheInvalidator implements ObserverInterface
{

    protected $typeList;


    protected $config;

    public function __construct(
        Config $config,
        TypeListInterface $typeList
    ) {
        $this->config = $config;
        $this->typeList = $typeList;
    }

    public function execute(Observer $observer)
    {
        if ($this->config->isEnabled()) {
            $this->typeList->invalidate(Type::TYPE_IDENTIFIER);
        }
    }
}
