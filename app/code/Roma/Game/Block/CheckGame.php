<?php
namespace Roma\Game\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

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