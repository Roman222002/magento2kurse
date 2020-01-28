<?php
namespace Roma\OwnModule\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Roma\OwnModule\Model\CarCustomerModel;
use Roma\OwnModule\Model\ResourceModel\CarCustomer\Collection as CarCustomerCollection;
use Roma\OwnModule\Model\ResourceModel\CarCustomer\CollectionFactory as CarCustomerCollectionFactory;

/**
* Class CarCustomers
*/
class CarCustomers extends Template
{
/**
* @var CarCustomerCollectionFactory
*/
private $carCustomersCollectionFactory;

/**
* @var CarCustomerCollection|null
*/
private $carCustomersCollection;

/**
* @param Context $context
* @param CarCustomerCollectionFactory $carCustomersCollectionFactory
* @param array $data
*/
public function __construct(
Context $context,
CarCustomerCollectionFactory $carCustomersCollectionFactory,
array $data = []
) {
parent::__construct($context, $data);
$this->carCustomersCollectionFactory = $carCustomersCollectionFactory;
}

/**
* @return Template
*/
protected function _prepareLayout()
{
if ($this->carCustomersCollection === null) {
$this->carCustomersCollection = $this->carCustomersCollectionFactory->create();
$this->carCustomersCollection->setOrder(CarCustomerModel::CREATED_AT, 'ASC');
}

return parent::_prepareLayout();
}

/**
* @return CarCustomerCollection|null
*/
public function getCarCustomersCollection()
{
return $this->carCustomersCollection;
}
}