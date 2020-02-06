<?php
namespace Roma\Stalker\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Roma\Stalker\Model\StalkerModel;
class Stalker extends AbstractDb{

    const STALKER_TABLE="stalker_table";
    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(self::STALKER_TABLE,
            StalkerModel::ENTITY_ID);
    }

}