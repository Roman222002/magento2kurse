<?php

namespace Roma\Stalker\ViewModel;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class ExtraInfo
 */
class ExtraInfo implements ArgumentInterface
{
    const MAIN_ART = 'roma_artifact/settings_artifacts_list/main_artifact';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }


    public function mainArt()
    {
        $result = 1;
        try {
            $result = $this->scopeConfig->getValue(
                self::MAIN_ART,
                ScopeInterface::SCOPE_STORES
            );
        } catch (\Exception $exception) {
            // logger->debug();
        }

        return (int)$result;
    }
}