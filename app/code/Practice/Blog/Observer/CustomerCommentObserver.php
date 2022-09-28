<?php
namespace Practice\Blog\Observer;

use Magento\Framework\Event\ObserverInterface;
use Practice\Blog\Helper\Email;


class CustomerCommentObserver implements ObserverInterface
{
    private $helperEmail;

    public function __construct(
        Email $helperEmail
    ) {
        $this->helperEmail = $helperEmail;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        return $this->helperEmail->sendEmail();
    }
}
