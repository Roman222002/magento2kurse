<?php


namespace Roma\Stalker\Model;


use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResultsInterface;
use Roma\Stalker\Api\Data\ArtifactsInterface;
use Roma\Stalker\Api\ArtifactsService;
use Roma\Stalker\Api\ArtifactsRepositoryInterface;

/**
 * Class ArtifactServices
 */
class ArtifactsServices implements ArtifactsService
{
    /**
     * @var ArtifactsRepositoryInterface
     */
    private $artRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @param ArtifactsRepositoryInterface $artRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        ArtifactsRepositoryInterface $artRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->artRepository = $artRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @param int $stalkerId
     * @return mixed
     */
    public function getArtifactsList($stalkerId)
    {
        if (empty($stalkerId)) {
            /** @var SearchCriteria $searchCriteria */
            $searchCriteria = $this->searchCriteriaBuilder->create();
        }else {
            /** @var SearchCriteria $searchCriteria */
            $searchCriteria = $this->searchCriteriaBuilder
                ->addFilter(ArtifactsInterface::STALKER_ID, $stalkerId)
                ->create();
        }
        /** @var SearchResultsInterface $searchResults */
        $searchResults = $this->artRepository->getList($searchCriteria);
        $resultArray = [];
        if ($searchResults->getTotalCount() > 0) {
            foreach ($searchResults->getItems() as $item) {
                /** @var ArtifactsInterface $item */
                $resultArray[] = [
                    'id' => $item->getId(),
                    'title' => $item->getTitle(),
                    'description' => $item->getDescription(),
                    'stalkerId' => $item->getStalkerId(),
                ];
            }
        }

        return $resultArray;
    }


}