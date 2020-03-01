<?php
namespace Roma\Stalker\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Roma\Stalker\Model\ArtefactsModel;
use Roma\Stalker\Model\ResourceModel\Artefacts\Collection as ArtifactCollection;
use Roma\Stalker\Model\ResourceModel\Artefacts\CollectionFactory as ArtifactCollectionFactory;

/**
 * Class Artifact
 */
class Artifact extends Template
{
    /**
     * @var ArtifactCollectionFactory
     */
    private $artifactCollectionFactory;

    /**
     * @var ArtifactCollection|null
     */
    private $artifactCollection;

    /**
     * Cars constructor.
     * @param Context $context
     * @param ArtifactCollectionFactory $artifactCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        ArtifactCollectionFactory $artifactCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->artifactCollectionFactory = $artifactCollectionFactory;
    }

    /**
     * @return Template
     */
    protected function _prepareLayout()
    {
        /** @var \Magento\Framework\App\Request\Http $request */
        $request = $this->getRequest();
        $stalkerId = (int)$request->getParam(ArtefactsModel::STALKER_ID);
        if ($stalkerId > 0 && $this->artifactCollection === null) {
            $this->artifactCollection = $this->artifactCollectionFactory->create();
            $this->artifactCollection->addFieldToFilter(
                ArtefactsModel::STALKER_ID,
                ['eq' => $stalkerId]
            );
        }

        return parent::_prepareLayout();
    }

    /**
     * @return ArtifactCollection|null
     */
    public function getArtifactsCollection()
    {
        return $this->artifactCollection;
    }
}