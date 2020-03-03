<?php
namespace Roma\Stalker\Controller\Adminhtml\Artifacts;

use Magento\Backend\App\Action as BackendAction;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Roma\Stalker\Api\Data\ArtifactsInterface;
use Roma\Stalker\Api\ArtifactsRepositoryInterface;
use Roma\Stalker\Model\ResourceModel\Artefacts\Collection as ArtifactCollection;
use Roma\Stalker\Model\ResourceModel\Artefacts\CollectionFactory as ArtifactResourceCollectionFactory;

/**
 * Class MassDelete
 */
class MassDelete extends BackendAction implements HttpPostActionInterface
{
    /**
     * {@inheritdoc}
     */
    const ADMIN_RESOURCE = 'Roma_Stalker::artifact_mass_delete';

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var ArtifactsRepositoryInterface
     */
    private $artifactRepository;

    /**
     * @var Filter
     */
    private $filter;

    /**
     * @var ArtifactResourceCollectionFactory
     */
    private $collectionFactory;

    /**
     * @param Context $context
     * @param ArtifactsRepositoryInterface $artifactRepository
     * @param ArtifactResourceCollectionFactory $collectionFactory
     * @param Filter $filter
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Context $context,
        ArtifactsRepositoryInterface $artifactRepository,
        ArtifactResourceCollectionFactory $collectionFactory,
        Filter $filter,
        DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->filter = $filter;
        $this->artifactRepository = $artifactRepository;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        try {
            /** @var ArtifactCollection $collection */
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            $count = 0;
            foreach ($collection as $artifact) {
                /** @var ArtifactsInterface $artifacts */
                if ($this->artifactRepository->delete($artifacts)) {
                    $count++;
                }
            }

            $message = __('A total of %1 record(s) have been deleted.', $count);
            $this->messageManager->addSuccessMessage($message);
            $this->dataPersistor->clear('artifact');
            return $resultRedirect->setPath('*/*/');
        } catch (NoSuchEntityException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while deleting artifacts.'));
        }

        return $resultRedirect->setPath('*/*/');
    }
}
