<?php

/**
 * Class Cars
 */
namespace Roma\OwnModule\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Roma\OwnModule\Model\CarModel;
use Roma\OwnModule\Model\ResourceModel\CarResource\Collection as CarsCollection;
use Roma\OwnModule\Model\ResourceModel\CarResource\CollectionFactory as CarsCollectionFactory;

/**
 * Class Cars
 */
class Cars extends Template
{
    /**
     * @var CarsCollectionFactory
     */
    private $carsCollectionFactory;

    /**
     * @var CarsCollection|null
     */
    private $carsCollection;

    /**
     * @param Context $context
     * @param CarsCollectionFactory $carsCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        CarsCollectionFactory $carsCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->carsCollectionFactory = $carsCollectionFactory;
    }

    /**
     * @return Template
     */
    protected function _prepareLayout()
    {
        /** @var \Magento\Framework\App\Request\Http $request */
        $request = $this->getRequest();
        $userId = (int)$request->getParam(CarModel::USER_ID);
        if ( $this->carsCollection === null) {
            $this->carsCollection = $this->carsCollectionFactory->create();
           $this->carsCollection->addFieldToFilter(
                CarModel::USER_ID,
                ['eq' => 0]
            );
        }

        return parent::_prepareLayout();
    }

    /**
     * @return CarsCollection|null
     */
    public function getCarsCollection()
    {
        return $this->carsCollection;
    }
}