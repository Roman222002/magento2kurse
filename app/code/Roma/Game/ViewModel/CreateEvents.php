<?php
namespace Roma\Game\ViewModel;
class CreateEvents
{
    /**
     * @var EventManager
     */
    private $eventManager;

    public function __construct(
        \Magento\Framework\Event\Manager $eventManager
    )
    {
        $this->eventManager = $eventManager;
    }

    public function see_customer_games_event()
    {
        $eventData = null;
        $this->eventManager->dispatch('see_customer_games');
    }
}