<?php
namespace Roma\Stalker\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Message\ManagerInterface;

/**
 * Class MyCustomObserver
 */
class MessageObserver implements ObserverInterface
{
    /**
     * @var ManagerInterface
     */
    private $messageManager;

    /**
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        ManagerInterface $messageManager
    ) {
        $this->messageManager = $messageManager;
    }

    /**
     * {@inheritDoc}
     */
    public function execute(Observer $observer)
    {
        $event = $observer->getEvent();
        $product = $event->getData('product');
        $date = new \DateTime('now');
        
        $message = __(
            'You added product with color "',
            $color = (explode("-", $product->getSku()))[2],
            $date->format('F j, Y, g:i a')
        );
        if($color=="Black"){
            $message="Dark color is not good for you, because you are girl";
        } elseif($color=="Blue"){
            $message="This color only for men";
        }else
            $message="This is best for you!";

        $this->messageManager->addSuccessMessage($message);
    }
}