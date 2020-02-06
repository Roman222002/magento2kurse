<?php


namespace Roma\Stalker\Model;


use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResultsInterface;
use Roma\Stalker\Api\StalkerServiceInterface;
use Roma\Stalker\Api\Data\StalkerInterface;
use Roma\Stalker\Api\StalkerRepositoryInterface;

/**
 * Class CarsService
 */
class StalkerServices implements StalkerServiceInterface
{
    /**
     * @var StalkerRepositoryInterface
     */
    private $stalkerRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @param StalkerRepositoryInterface $stalkerRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        StalkerRepositoryInterface $stalkerRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->stalkerRepository = $stalkerRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

   /**
     * @param int $stalkerId
     * @return array|mixed
     */
    public function getStalkerList($stalkerId)
    {
        if (empty($stalkerId)) {
            /** @var SearchCriteria $searchCriteria */
            $searchCriteria = $this->searchCriteriaBuilder->create();
        }else {
            /** @var SearchCriteria $searchCriteria */
            $searchCriteria = $this->searchCriteriaBuilder
                ->addFilter(StalkerInterface::ENTITY_ID, $stalkerId)
                ->create();
        }
        /** @var SearchResultsInterface $searchResults */
        $searchResults = $this->stalkerRepository->getList($searchCriteria);
        $resultArray = [];
        if ($searchResults->getTotalCount() > 0) {
            foreach ($searchResults->getItems() as $item) {
                /** @var StalkerInterface $item */
                $resultArray[] = [
                    'id' => $item->getId(),
                    'nickname' => $item->getNickname(),
                    'name' => $item->getName(),
                    'grouping' => $item->getGrouping(),
                    'created_at' => $item->getCreatedAt(),
                ];
            }
        }

        return $resultArray;
    }

    /**
     * @param $stalkerId
     * @param $word
     * @return string
     */
    public function setStalker($stalkerId, $word)
    {
            /** @var SearchCriteria $searchCriteria */
            $searchCriteria = $this->searchCriteriaBuilder
                ->addFilter(StalkerInterface::ENTITY_ID, $stalkerId)
                ->create();

        /** @var SearchResultsInterface $searchResults */
        $searchResults = $this->stalkerRepository->getList($searchCriteria);
        /** @var StalkerInterface[] $item */
        $items = $searchResults->getItems();
        $item = array_shift($items);
        $item->setNickname($word);
        $this->stalkerRepository->save($item);
        return $stalkerId . ' '. $word;
    }
}