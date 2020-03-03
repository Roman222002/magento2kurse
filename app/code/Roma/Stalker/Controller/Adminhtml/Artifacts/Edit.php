<?php
namespace Roma\Stalker\Controller\Adminhtml\Artifacts;

use Magento\Backend\App\Action as BackendAction;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Roma\Stalker\Api\Data\ArtifactsInterface;
use Roma\Stalker\Api\Data\ArtifactsInterfaceFactory;
use Roma\Stalker\Api\ArtifactsRepositoryInterface;

/**
 * Class Edit
 */
class Edit extends BackendAction implements HttpGetActionInterface
{
    /**
     * {@inheritdoc}
     */
    const ADMIN_RESOURCE = 'Roma_Test::artifact_edit';

    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * @var ArtifactsRepositoryInterface
     */
    private $artifactRepository;

    /**
     * @var ArtifactsInterfaceFactory
     */
    private $artifactsFactory;

    /**
     * @param Context $context
     * @param ArtifactsRepositoryInterface $artifactRepository
     * @param ArtifactsInterfaceFactory $artifactFactory
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        ArtifactsRepositoryInterface $artifactRepository,
        ArtifactsInterfaceFactory $artifactsFactory,
        PageFactory $resultPageFactory
    ) {
        $this->artifactRepository = $artifactRepository;
        $this->artifactsFactory = $artifactsFactory;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        $id = (int)$this->getRequest()->getParam(ArtifactsInterface::ENTITY_ID);

        if ($id) {
            try {
                $model = $this->artifactRepository->getById($id);
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__($e->getMessage()));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        } else {
            $model = $this->artifactsFactory->create();
        }

        /** @var ResultInterface $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Roma_Test::roma_manage_artifacts');

        $resultPage->getConfig()->getTitle()->prepend(__('Artifact'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New Artifact'));
        return $resultPage;
    }
}