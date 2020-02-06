<?php


namespace Roma\Stalker\Model;

use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Roma\Stalker\Api\StalkerRepositoryInterface;
use Roma\Stalker\Api\Data\StalkerInterface;
use Roma\Stalker\Model\StalkerModelFactory;
use Roma\Stalker\Model\ResourceModel\Stalker\Collection;
use Roma\Stalker\Model\ResourceModel\Stalker\CollectionFactory as StalkerCollectionFactory;
use Roma\Stalker\Model\ResourceModel\Stalker as StalkerResource;

/**
 * Class StalkerRepository
 */
class StalkerRepository implements StalkerRepositoryInterface
{
    /**
     * @var StalkerModelFactory
     */
    private $stalkerFactory;

    /**
     * @var StalkerCollectionFactory
     */
    private $stalkerCollectionFactory;

    /**
     * @var StalkerResource
     */
    private $resource;

    /**
     * @type SearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @type CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @param StalkerModelFactory $stalkerFactory
     * @param StalkerCollectionFactory $stalkerCollectionFactory
     * @param StalkerResource $resource
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        StalkerModelFactory $stalkerFactory,
        StalkerCollectionFactory $stalkerCollectionFactory,
        StalkerResource $resource,
        SearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    )
    {
        $this->stalkerFactory = $stalkerFactory;
        $this->stalkerCollectionFactory = $stalkerCollectionFactory;
        $this->resource = $resource;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }


    /**
     * @param StalkerInterface $stalker
     * @return StalkerInterface
     * @throws CouldNotSaveException
     */
    public function save(StalkerInterface $stalker): StalkerInterface
    {
        try {

            $this->resource->save($stalker);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $stalker;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $stalkerId): StalkerInterface
    {
        /** @var StalkerModel|StalkerInterface $stalker */
        $stalker = $this->stalkerFactory->create();
        $stalker->load($stalkerId);
        if (!$stalker>getId()) {
            throw new NoSuchEntityException(__('Stalker entity with id `%1` does not exist.', $stalkerId));
        }

        return $stalker;
    }

    /**
     * {@inheritDoc}
     */
    public function getList(SearchCriteriaInterface $criteria): SearchResults
    {
        /** @var Collection $collection */
        $collection = $this->stalkerCollectionFactory->create();
        $this->collectionProcessor->process($criteria, $collection);

        /** @var SearchResults $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritDoc}
     */
    public function delete(StalkerInterface $stalker): bool
    {
        try {
            /** @var StalkerModel $stalker */
            $this->resource->delete($stalker);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function deleteById(int $stalkerId): bool
    {
        return $this->delete($this->getById($stalkerId));
    }

}