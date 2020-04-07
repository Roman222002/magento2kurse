<?php
namespace Roma\Game\Block;

use Magento\Framework\Api\Search\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Roma\Game\Api\Data\GameCustomerInterface;
use Roma\Game\Api\Data\GameInterface;
use Roma\Game\Model\GameModel;
use Roma\Game\Model\ResourceModel\GameCustomer\Collection as GameCustomerCollection;
use Roma\Game\Model\ResourceModel\GameCustomer\CollectionFactory as GameCustomerCollectionFactory;
use Roma\Game\Api\GameCustomerRepositoryInterface;

/**
 * Class GameCustomer
 */
class GameCustomer extends Template
{
    /**
     * @var GameCustomerCollectionFactory
     */
    private $gameCustomerCollectionFactory;

    /**
     * @var GameCustomerCollection|null
     */
    private $gameCustomerCollection;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var gameCustomerRepositoryInterface
     */
    private $gameCustomerRepository;

    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;

    const GAME_ACTION_ROUTE = 'game_route/index/games';

    /**
     * Game Customer constructor.
     * @param Context $context
     * @param GameCustomerCollectionFactory $gameCustomerCollectionFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param GameCustomerRepositoryInterface $gameCustomerRepository
     * @param SortOrderBuilder $sortOrderBuilder
     * @param array $data
     */
    public function __construct(Context $context,
        GameCustomerCollectionFactory $gameCustomerCollectionFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        GameCustomerRepositoryInterface $gameCustomerRepository,
        SortOrderBuilder $sortOrderBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->gameCustomerCollectionFactory = $gameCustomerCollectionFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->gameCustomerRepository = $gameCustomerRepository;
    }

    /**
     * @return Template
     */
    protected function _prepareLayout()
    {
        /** @var \Magento\Framework\App\Request\Http $request */
        $request = $this->getRequest();
        $gameCustomerSort = $request->getParam('sort');
        if ($this->gameCustomerCollection === null) {
            $sortOrder = $this->sortOrderBuilder
                ->setField(GameCustomerInterface::CREATED_AT)
                ->setDirection($gameCustomerSort)
                ->create();

            /** @var SearchCriteria|SearchCriteriaInterface $searchCriteria */
            $searchCriteria = $this->searchCriteriaBuilder
                ->addSortOrder($sortOrder)
                ->create();

            /** @var SearchResults $searchResults */
            $searchResults = $this->gameCustomerRepository->getList($searchCriteria);
            if ($searchResults->getTotalCount() > 0) {
                $this->gameCustomerCollection = $searchResults->getItems();
            }
        }
        return parent::_prepareLayout();
    }

    /**
     * @return GameCustomerCollection|null
     */
    public function getGameCustomersCollection()
    {
        return $this->gameCustomerCollection;
    }

    /**
     * @param $customerId
     * @return string
     */
    public function getGameCustomerUrl($customerId)
    {
        return $this->getUrl(
            self::GAME_ACTION_ROUTE,
            [
                GameInterface::GAME_CUSTOMER_ID => $customerId
            ]
        );
    }
}