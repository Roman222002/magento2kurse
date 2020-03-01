<?php
namespace Roma\Stalker\Model;

use Magento\Framework\Model\AbstractModel;
use Roma\Stalker\Api\Data\ArtifactsInterface;
use Roma\Stalker\Model\ResourceModel\Artefacts as ArtifactsResourceModel;

class ArtefactsModel extends AbstractModel implements ArtifactsInterface{

    public function _construct()
    {
        $this->_init(ArtifactsResourceModel::class);
    }
    /**
     * @return int|mixed
     */
    public function getId(){
        return $this->getData(self::ENTITY_ID);
    }
    /**
     * @inheritDoc
     */
    public function getStalkerId()
    {
        return $this->getData(self::STALKER_ID);
    }

    /**
     * @inheritDoc
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @inheritDoc
     */
    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);

    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setStalkerId(int $stalkerId): ArtifactsInterface
    {
        return $this->setData(self::STALKER_ID, $stalkerId);
    }

    /**
     * @inheritDoc
     */
    public function setTitle(string $title): ArtifactsInterface
    {
        return $this->setData(self::TITLE,$title);
    }

    /**
     * @inheritDoc
     */
    public function setDescription(string $description): ArtifactsInterface
    {
        return $this->setData(self::DESCRIPTION,$description);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt(\DateTime $createdAt): ArtifactsInterface
    {
        return $this->setData(self::CREATED_AT,$createdAt);
    }
}
