<?php

namespace Roma\Stalker\Model;

use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Roma\Stalker\Api\ArtifactsRepositoryInterface;
use Roma\Stalker\Api\Data\ArtifactsInterface;
use Roma\Stalker\Model\ArtefactsModelFactory;
use Roma\Stalker\Model\ResourceModel\Artefacts\Collection;
use Roma\Stalker\Model\ResourceModel\Artefacts\CollectionFactory as ArtifactsCollectionFactory;
use Roma\Stalker\Model\ResourceModel\Artefacts as ArtifactsResource;

/**
 * Class ArtifactsRepository
 */
class ArtifactsRepository implements ArtifactsRepositoryInterface
{
    /**
     * @var ArtefactsModelFactory
     */
    private $artifactsModelFactory;

    /**
     * @var ArtifactsCollectionFactory
     */
    private $artifactsCollectionFactory;

    /**
     * @var ArtifactsResource
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
     * @param ArtefactsModelFactory $artifactsModelFactory
     * @param ArtifactsCollectionFactory $artifactsCollectionFactory
     * @param ArtifactsResource $resource
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ArtefactsModelFactory $artifactsModelFactory,
        ArtifactsCollectionFactory $artifactsCollectionFactory,
        ArtifactsResource $resource,
        SearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->artifactsModelFactory = $artifactsModelFactory;
        $this->artifactsCollectionFactory = $artifactsCollectionFactory;
        $this->resource = $resource;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * {@inheritdoc}
     */
    public function save(ArtifactsInterface $artifact): ArtifactsInterface
    {
        try {
            /** @var  ArtefactsModel|ArtifactsInterface $car */
            $this->resource->save($artifact);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $artifact;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $stalkerId): ArtifactsInterface
    {
        /** @var ArtefactsModel|ArtifactsInterface $artifact */
        $artifact = $this->artifactsModelFactory->create();
        $artifact->load($stalkerId);
        if (!$artifact->getId()) {
            throw new NoSuchEntityException(__('Artifact entity with id `%1` does not exist.', $artifact));
        }

        return $artifact;
    }

    /**
     * {@inheritDoc}
     */
    public function getList(SearchCriteriaInterface $criteria): SearchResults
    {
        /** @var Collection $collection */
        $collection = $this->artifactsCollectionFactory->create();
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
    public function delete(ArtifactsInterface $artifacts): bool
    {
        try {
            /** @var ArtefactsModel $artifacts */
            $this->resource->delete($artifacts);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function deleteById(int $artifactId): bool
    {
        return $this->delete($this->getById($artifactId));
    }
}