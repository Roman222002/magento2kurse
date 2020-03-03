<?php
namespace Roma\Stalker\Block\Adminhtml\Buttons;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Roma\Stalker\Api\ArtifactsRepositoryInterface;
use Roma\Stalker\Api\Data\ArtifactsInterface;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var ArtifactsRepositoryInterface
     */
    private $artifactRepository;

    /**
     * @param Context $context
     * @param ArtifactsRepositoryInterface $artifactRepository
     */
    public function __construct(
        Context $context,
        ArtifactsRepositoryInterface $artifactRepository
    ) {
        $this->context = $context;
        $this->artifactRepository = $artifactRepository;
    }

    /**
     * @return int|null
     */
    public function getStalkerId()
    {
        try {
            $request = $this->context->getRequest();
            $stalkerId = (int)$request->getParam(ArtifactsInterface::ENTITY_ID);
            return $this->artifactRepository->getById($stalkerId)->getId();
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }

    /**
     * Generate url by route and parameters
     *
     * @param string $route
     * @param array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}