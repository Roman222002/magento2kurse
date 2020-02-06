<?php
namespace Roma\Stalker\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Roma\Stalker\Api\Data\StalkerInterface;

interface StalkerRepositoryInterface{
    /**
     * @param StalkerInterface $stalker
     * @return StalkerInterface
     */
    public function save(StalkerInterface $stalker): StalkerInterface;

    /**
     * @param int $stalkerId
     * @return StalkerInterface
     */
    public function getById(int $stalkerId): StalkerInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResults
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResults;

    /**
     * @param StalkerInterface $stalker
     * @return bool
     */
    public function delete(StalkerInterface $stalker): bool;

    /**
     * @param int $stalkerId
     * @return bool
     */

    public function deleteById(int $stalkerId): bool;


}