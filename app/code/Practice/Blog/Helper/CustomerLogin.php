<?php

namespace Practice\Blog\Helper;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\UrlInterface;

class CustomerLogin extends AbstractHelper
{

    protected $urlInterface;

    public function __construct(
        Context $context,
        Session $customerSession
    ) {
        parent::__construct($context);
        $this->customerSession = $customerSession;
        $this->urlInterface = $context->getUrlBuilder();
    }

    public function redirectIfNotLoggedIn()
    {
        if (!$this->customerSession->isLoggedIn()) {
            $this->customerSession->setAfterAuthUrl($this->urlInterface->getCurrentUrl());
            $this->customerSession->authenticate();
        }
    }

    public function checkIsLoggedIn()
    {
        if (!$this->customerSession->isLoggedIn()) {
            return false;
        }
        return true;
    }
}
