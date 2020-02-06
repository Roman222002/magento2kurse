<?php

namespace Roma\Stalker\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Psr\Log\LoggerInterface;

/**
 * Class PutDataIntoMyNewTable
 */
class InitData implements DataPatchInterface
{
    const STALKER_TABLE = 'stalker_table';
    const ARTIFACTS_TABLE = 'artifacts_table';
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param LoggerInterface $logger
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        LoggerInterface $logger
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $data_stalkers = [
            [
                'entity_id' => null,
                'nickname' => 'Schram',
                'grouping' => 'mercenaries',
                'name' => 'Sergey',
                'created_at' => '',
            ],
            [
                'entity_id' => null,
                'nickname' => 'Strelok',
                'grouping' => 'loner',
                'name' => 'Pavel',
                'created_at' => '',
            ],
            [
                'entity_id' => null,
                'nickname' => 'Kovalski',
                'grouping' => 'dolg',
                'name' => 'Olexsander',
                'created_at' => '',
            ],
            [
                'entity_id' => null,
                'nickname' => 'Vano',
                'grouping' => 'freedom',
                'name' => 'Ivan',
                'created_at' => '',
            ],
        ];
        $data_artifacts=[
            [
                'entity_id' => null,
                'stalker_id' => 1,
                'title' => 'Meduza',
                'description' => 'Radiation -2',
                'created_at' => '',
            ],
            [
                'entity_id' => null,
                'stalker_id' => 1,
                'title' => 'Part of Meat',
                'description' => 'Power +2',
                'created_at' => '',
            ],
            [
                'entity_id' => null,
                'stalker_id' => 2,
                'title' => 'Blood of stone',
                'description' => 'Telepathy +3',
                'created_at' => '',
            ],
            [
                'entity_id' => null,
                'stalker_id' => 3,
                'title' => 'Gold fish',
                'description' => 'Weight +15 kg',
                'created_at' => '',
            ],
            [
                'entity_id' => null,
                'stalker_id' => 4,
                'title' => 'Vivert',
                'description' => 'Weight +10 kg',
                'created_at' => '',
            ],
        ];
        $this->moduleDataSetup->startSetup();
        echo 'Roma_Stalker:PutDataIntoStalkerTable:Data:startSetup' . "\r\n";

        try {
            $connection = $this->moduleDataSetup->getConnection();
            foreach ($data_stalkers as $row) {
                $row['created_at'] = time();
                $connection->insert(self::STALKER_TABLE, $row);
            }
            foreach ($data_artifacts as $row) {
                $row['created_at'] = time();
                $connection->insert(self::ARTIFACTS_TABLE, $row);
            }
        } catch (\Exception $exception) {
            $this->logger->debug('Cannot insert row, message: "'. $exception->getMessage() . '"');
        }

        $this->moduleDataSetup->endSetup();
        echo 'Roma_Test:PutDataIntoMyNewTable:Data:endSetup' . "\r\n";
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
