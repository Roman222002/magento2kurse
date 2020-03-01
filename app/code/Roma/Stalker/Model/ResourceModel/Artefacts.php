<?php
namespace Roma\Stalker\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Roma\Stalker\Model\ArtefactsModel;

/**
 * Class CarResource
 */
class Artefacts extends AbstractDb
{
    const ARTIFACT_TABLE = 'artifacts_table';

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_init(
            self::ARTIFACT_TABLE,
            ArtefactsModel::ENTITY_ID
        );
    }
}