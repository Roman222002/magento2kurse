<?php


namespace Roma\Stalker\Block;

use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Roma\Stalker\Model\StalkerModel;
use Roma\Stalker\Api\Data\StalkerInterface;
use Roma\Stalker\Api\StalkerRepositoryInterface;
use Roma\Stalker\Model\ResourceModel\Stalker\Collection as StalkerCollection;
use Roma\Stalker\Model\ResourceModel\Stalker\CollectionFactory as StalkerCollectionFactoty;

class Stalker extends Template
{
    /**
     * @var StalkerCollectionFactoty
     */
    private $stalkerCollectionFactory;
    /**
     * @var StalkerCollection|null
     */
    private $stalkerCollection;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var StalkerRepositoryInterface
     */
    private $stalkerRepository;

    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;


    public function __construct(Context $context, StalkerCollectionFactoty $stalkerCollectionFactory,
                                SearchCriteriaBuilder $searchCriteriaBuilder,
                                StalkerRepositoryInterface $stalkerRepository,
                                SortOrderBuilder $sortOrderBuilder,
                                array $data = [])
    {
        parent::__construct($context, $data);
        $this->stalkerCollectionFactory = $stalkerCollectionFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->stalkerRepository = $stalkerRepository;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }

    protected function _prepareLayout()
    {
        if ($this->stalkerCollection === null) {
            $sortOrder = $this->sortOrderBuilder
                ->setField(StalkerInterface::CREATED_AT)
                ->setDirection(SortOrder::SORT_ASC)
                ->create();

            /** @var SearchCriteria|SearchCriteriaInterface $searchCriteria */
            $searchCriteria = $this->searchCriteriaBuilder
                ->addSortOrder($sortOrder)
                ->create();

            /** @var SearchResults $searchResults */
            $searchResults = $this->stalkerRepository->getList($searchCriteria);
            if ($searchResults->getTotalCount() > 0) {
                $this->stalkerCollection = $searchResults->getItems();
            }
        }
        return parent::_prepareLayout();
    }
    /**
     * @return StalkerCollection
     */
    public function getStalkerCollection(){
        return $this->stalkerCollection;
    }
}