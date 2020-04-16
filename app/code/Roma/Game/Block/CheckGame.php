<?php
namespace Roma\Game\Block;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Roma\Game\Api\Data\GameInterface;

class CheckGame extends Template
{
    private $gameId;

public function setGameId($id){
    $this->gameId=$id;
}
public function getGameId(){
        return $this->gameId;
}
}