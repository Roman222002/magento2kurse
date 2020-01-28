<?php

namespace Roma\OwnModule\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Roma\OwnModule\Model\CarCustomerModel;

/**
 * Class CarCustomer
 */
class CarCustomer extends AbstractDb
{
    const CAR_CUSTOMER_TABLE = 'my_own_table';

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(
            self::CAR_CUSTOMER_TABLE,
            CarCustomerModel::ENTITY_ID
        );
    }
}