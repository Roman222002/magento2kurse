<?php

namespace Roma\Stalker\Model\ResourceModel\Artefacts;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Roma\Stalker\Model\ArtefactsModel;
use Roma\Stalker\Model\ResourceModel\Artefacts as ArtefactsResourceModel;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * {@inheritdoc}
     */
    protected $_idFieldName = ArtefactsModel::ENTITY_ID;

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(
            ArtefactsModel::class,
            ArtefactsResourceModel::class
        );
    }
}