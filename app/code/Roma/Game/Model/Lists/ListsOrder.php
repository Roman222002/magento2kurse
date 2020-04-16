<?php
namespace Roma\Game\Model\Lists;

use Magento\Framework\Api\SortOrder;
use Magento\Framework\Data\OptionSourceInterface;

class ListsOrder implements OptionSourceInterface{

    public function toOptionArray()
    {
        $resultArray[] = [
            'label' => 'ASC',
            'value' => SortOrder::SORT_ASC];
        $resultArray[] = [
            'label' => 'DESC',
            'value' => SortOrder::SORT_DESC];
        return $resultArray;
    }
}