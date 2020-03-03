<?php
namespace Roma\Stalker\Block\Adminhtml\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Roma\Stalker\Api\Data\ArtifactsInterface;

/**
 * Class DeleteButton
 * @package Roma\Stalker
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        $stalkerId = $this->getStalkerId();
        if ($stalkerId) {
            $data = [
                'label' => __('Delete Artifact'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                        'Are you sure you want to do this?'
                    ) . '\', \'' . $this->getDeleteUrl($stalkerId) . '\')',
                'sort_order' => 20,
            ];
        }

        return $data;
    }

    /**
     * @param int|string
     * @return string
     */
    public function getDeleteUrl($stalkerId)
    {
        return $this->getUrl('*/*/delete', [ArtifactsInterface::ENTITY_ID => $stalkerId]);
    }
}