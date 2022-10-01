<?php

namespace Practice\Blog\Controller\All;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

use Magento\Framework\View\Result\PageFactory;
use Practice\Blog\Model\Blog;
use Practice\Blog\Model\BlogCategory;



class Index extends Action
{
    private $pageFactory;
    protected $blog;

    public function __construct(Context $context, PageFactory $pageFactory, Blog $blog)
    {
        $this->blog = $blog;
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        // for ($i = 1; $i <= 300; $i++) {
        //     $blogElement = $this->blog;
        //     $blogElement->setData('title', 'Title blog '. $i);
        //     $blogElement->setData('content', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus fringilla felis in felis pretium, at tincidunt arcu vulputate. Fusce venenatis congue tortor, vitae efficitur arcu pharetra et. Curabitur quis mi sit amet lectus viverra placerat. Duis porttitor ante ac eros faucibus, vitae fringilla ante iaculis. In aliquam dignissim felis ut laoreet. Donec vel vehicula est. Vestibulum consequat odio vitae justo consectetur, quis lobortis eros hendrerit. Etiam malesuada eleifend justo, sit amet varius massa vulputate nec. Sed vel purus blandit, porttitor est a, semper felis. Praesent velit nunc, pellentesque eget lacus quis, malesuada porta odio.

        //     Sed ullamcorper ullamcorper lectus non placerat. Quisque vel malesuada dolor, ac faucibus lacus. Praesent risus tellus, tempus vitae eros non, facilisis vehicula lectus. Nam efficitur orci bibendum molestie aliquet. Nunc non velit eu nisl sodales volutpat. Vivamus consectetur et mauris eget auctor. Vivamus at diam ut sem volutpat dignissim nec et nulla. Mauris auctor lacus in luctus bibendum. Morbi tincidunt sollicitudin leo, non blandit felis vestibulum ac.

        //     Aenean ac iaculis sem. In hac habitasse platea dictumst. Aliquam rutrum fermentum risus ac tincidunt. Vivamus quis sem a nisl tristique interdum id in mauris. In eu dolor nec metus feugiat aliquam. Aliquam eget augue eget ligula mattis posuere sed et dolor. Curabitur id est imperdiet, venenatis purus eget, rhoncus nunc. Donec dictum elit lorem, eu commodo sapien interdum sed. Sed molestie neque a ligula aliquet, id pulvinar neque porttitor. Morbi aliquam nisi quis ipsum consectetur, in mattis metus finibus. Quisque volutpat ligula non sollicitudin commodo. Etiam semper venenatis elementum. Aenean accumsan mi augue, et iaculis nisi luctus ut. Lorem ipsum dolor sit amet, consectetur adipiscing elit.

        //     Ut pharetra vestibulum rutrum. In eget fringilla sem, at hendrerit nisi. Phasellus volutpat leo eget molestie sagittis. Duis ullamcorper lectus in posuere posuere. Suspendisse sagittis porttitor ex, vitae pellentesque lacus convallis sed. Vestibulum eu augue lectus. Nullam eget placerat magna. Ut iaculis augue sit amet ipsum rutrum, a facilisis turpis vestibulum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin et accumsan nunc, ac commodo magna. Maecenas feugiat orci nisl, vel imperdiet nibh placerat eget. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent iaculis ornare dapibus. Proin eget scelerisque nulla. Fusce id purus arcu.

        //     Aliquam tortor odio, ultrices sit amet lacus in, scelerisque viverra eros. Morbi vestibulum sapien felis, iaculis tempus nisl vulputate ut. Pellentesque lectus dolor, semper eu arcu a, scelerisque vestibulum eros. Nam ut vestibulum eros. Cras in tortor auctor, sagittis libero eu, ultrices sem. Quisque faucibus molestie nibh, ac tempus elit varius sit amet. In sodales elit id dignissim interdum. Donec tincidunt augue non lacus congue dignissim. Mauris mattis tristique ex non bibendum. Pellentesque a lectus tellus. Vivamus faucibus, lorem at eleifend viverra, urna eros finibus turpis, vel aliquet augue nisl vel mi. In auctor facilisis urna, et pulvinar arcu gravida non. Nam semper lacinia convallis. Donec ac metus in lectus egestas ultrices. Sed vestibulum sapien in auctor sodales.');
        //     $blogElement->setData('user_id', 1);
        //     $blogElement->setData('blog_status_id', 1);

        //     $blogElement->save();
        //     $blogElement->unsetData();
        // }




        return ($this->pageFactory->create());
    }
}
