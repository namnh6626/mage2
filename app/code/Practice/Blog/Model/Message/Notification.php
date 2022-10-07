<?php
namespace Practice\Blog\Model\Message;

class Notification implements \Magento\Framework\Notification\MessageInterface
{
   public function getIdentity()
   {
       // Retrieve unique message identity
       return 'identity';
   }
   public function isDisplayed()
   {
       // Return true to show your message, false to hide it
       return true;
   }
   public function getText()
   {
       // message text

       return "Notification Add Successfully";
   }
   public function getSeverity()
   {
       // Possible values:
       // SEVERITY_CRITICAL
       // SEVERITY_MAJOR
       // SEVERITY_MINOR
       // SEVERITY_NOTICE
       return self::SEVERITY_NOTICE;
   }
}
