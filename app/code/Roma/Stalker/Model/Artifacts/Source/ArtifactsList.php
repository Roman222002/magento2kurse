<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Roma\Stalker\Model\Artifacts\Source;

use Magento\Framework\Api\SearchResultsInterface;
use Roma\Stalker\Api\ArtifactsRepositoryInterface as ArtInterfase;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Roma\Stalker\Api\Data\ArtifactsInterface;

/**
 * Class Theme
 */

class ArtifactsList implements OptionSourceInterface
{
    /**
     * @var ArtInterfase
     */
    protected $artList;
    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * Constructor
     *
     * @param ArtInterfase $artList
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     *

     */
    public function __construct(ArtInterfase $artList,SearchCriteriaBuilder $searchCriteriaBuilder)
    {
        $this->artList = $artList;
        $this->searchCriteriaBuilder=$searchCriteriaBuilder;
    }

    /**
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function toOptionArray()
    {
        /** @var SearchCriteria $searchCriteria */
        $searchCriteria = $this->searchCriteriaBuilder->create();

        /** @var SearchResultsInterface $data */
        $data = $this->artList->getList($searchCriteria);
        $resultArray = [];
        if ($data->getTotalCount() > 0) {
            foreach ($data->getItems() as $item) {
                /** @var ArtifactsInterface $item */
                $resultArray[] = [
                    'label'=>'Id '.$item->getId().' '.$item->getTitle(),
                    'value' => $item->getId(),
                ];
            }
        }
        $options[] = ['label' => 'Default', 'value' => ''];

        return $resultArray;
    }
}
