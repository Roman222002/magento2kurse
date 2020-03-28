<?php

namespace Roma\Stalker\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Psr\Log\LoggerInterface;
use Magento\Cms\Model\BlockFactory;

/**
 * Class PutDataIntoMyNewTable
 */
class InitBlock implements DataPatchInterface
{
    private $blockFactory;

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
        LoggerInterface $logger,
        BlockFactory $blockFactory
    )
    {
        $this->blockFactory=$blockFactory;
        $this->moduleDataSetup = $moduleDataSetup;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {

        $this->moduleDataSetup->startSetup();
        echo 'Roma_Stalker:PutDataIntoStalkerTable:Data:startSetup' . "\r\n";


            $staticBlockInfo = [
                'title' => 'Happy CMS block',
                'identifier' => 'roma_happy_block',
                'stores' => ['0'],
                'is_active' => 1,
                'content' => 'You will be happy(^_^)'
            ];
        try {
            $this->blockFactory->create()->setData($staticBlockInfo)->save();
        } catch (\Exception $exception) {
            $this->logger->debug('Cannot insert block, message: "'. $exception->getMessage() . '"');
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
