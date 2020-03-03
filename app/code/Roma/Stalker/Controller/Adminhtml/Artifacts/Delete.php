<?php
namespace Roma\Stalker\Controller\Adminhtml\Artifacts;

use Magento\Backend\App\Action as BackendAction;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Roma\Stalker\Api\Data\ArtifactsInterface;
use Roma\Stalker\Api\ArtifactsRepositoryInterface;

/**
 * Class Delete
 */
class Delete extends BackendAction implements HttpGetActionInterface
{
    /**
     * {@inheritdoc}
     */
    const ADMIN_RESOURCE = 'Roma_Stalker::artifacts_delete';

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var ArtifactsRepositoryInterface
     */
    private $artifactRepository;

    /**
     * @param Context $context
     * @param ArtifactsRepositoryInterface $artifactRepository
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Context $context,
        ArtifactsRepositoryInterface $artifactRepository,
        DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->artifactRepository=$artifactRepository;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = (int)$this->getRequest()->getParam(ArtifactsInterface::ENTITY_ID);

        try {
            $this->artifactRepository->deleteById($id);
            $this->messageManager->addSuccessMessage(__('You deleted artifact'));
            $this->dataPersistor->clear('artifacts');
            return $resultRedirect->setPath('*/*/');
        } catch (NoSuchEntityException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while deleting artifact.'));
        }

        return $resultRedirect->setPath('*/*/');
    }
}