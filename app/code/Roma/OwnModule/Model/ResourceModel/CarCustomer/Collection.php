<?php

namespace Roma\OwnModule\Model\ResourceModel\CarCustomer;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Roma\OwnModule\Model\CarCustomerModel;
use Roma\OwnModule\Model\ResourceModel\CarCustomer as CarCustomerResourceModel;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * {@inheritdoc}
     */
    protected $_idFieldName = CarCustomerModel::ENTITY_ID;

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(
            CarCustomerModel::class,
            CarCustomerResourceModel::class
        );
    }
}