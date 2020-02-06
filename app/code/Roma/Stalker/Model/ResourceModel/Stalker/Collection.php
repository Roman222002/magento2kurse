<?php
namespace Roma\Stalker\Model\ResourceModel\Stalker;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Roma\Stalker\Model\StalkerModel;
use Roma\Stalker\Model\ResourceModel\Stalker as StalkerResourceModel;

class Collection extends AbstractCollection{
    protected $_idFiledName=StalkerModel::ENTITY_ID;

    protected function _construct()
    {
        $this->_init(StalkerModel::class,
        StalkerResourceModel::class);
    }
}