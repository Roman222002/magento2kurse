<?php
namespace Roma\Stalker\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Roma\Stalker\Api\Data\ArtifactsInterface;

/**
 * Interface CarRepositoryInterface
 */
interface ArtifactsRepositoryInterface
{
    /**
     * Save Artifact entity
     *
     * @param ArtifactsInterface $artifact
     * @return ArtifactsInterface
     * @throws CouldNotSaveException
     */
    public function save(ArtifactsInterface $artifact): ArtifactsInterface;

    /**
     * Get Artifact by its id
     *
     * @param int $artifactId
     * @return ArtifactsInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $artifactId): ArtifactsInterface;

    /**
     * Get Artifact entities list
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResults
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResults;

    /**
     * Delete Artifact entity
     *
     * @param ArtifactsInterface $artifact
     * @return bool true on success
     * @throws LocalizedException
     */
    public function delete(ArtifactsInterface $artifact): bool;

    /**
     * Delete Artifact entity by id
     *
     * @param int $artifactId
     * @return bool true on success
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(int $artifactId): bool;
}