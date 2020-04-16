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
        $this->eventManager->dispatch('see_customer_games');
    }
    public function check_game_license()
    {
        $this->eventManager->dispatch('check_game_license');
    }
    public function get_game_collection($array)
    {
        $this->eventManager->dispatch('get_game_collection',$array);
    }
    public function get_game_customer_collection($array)
    {
        $this->eventManager->dispatch('get_game_customer_collection',$array);
    }
}