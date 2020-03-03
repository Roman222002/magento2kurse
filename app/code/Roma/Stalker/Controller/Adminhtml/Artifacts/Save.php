<?php

namespace Roma\Stalker\Controller\Adminhtml\Artifacts;

use Magento\Backend\App\Action as BackendAction;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\Request\Http as HttpRequest;
//use Magento\Catalog\Model\ImageUploader;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Controller\ResultInterface;
use Roma\Stalker\Api\ArtifactsRepositoryInterface;
use Roma\Stalker\Api\Data\ArtifactsInterface;
use Roma\Stalker\Api\Data\ArtifactsInterfaceFactory;
use Roma\Stalker\Model\ArtefactsModel;

/**
 * Class Save
 */
class Save extends BackendAction implements HttpPostActionInterface
{
    /**
     * {@inheritdoc}
     */
    const ADMIN_RESOURCE = 'Roma_Test::artifact_save';

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var ArtifactsRepositoryInterface
     */
    private $artifactRepository;

    /**
     * @var ArtifactsInterfaceFactory
     */
    private $artifactsFactory;
//
//    /**
//     * @var ImageUploader
//     */
//    private $imageUploader;

    /**
     * @param Context $context
     * @param ArtifactsRepositoryInterface $artifactRepository
     * @param ArtifactsInterfaceFactory $artifactsFactory
     * @param DataPersistorInterface $dataPersistor
    //     * @param ImageUploader $imageUploader
     */
    public function __construct(
        Context $context,
        ArtifactsRepositoryInterface $artifactRepository,
        ArtifactsInterfaceFactory $artifactsFactory,
        DataPersistorInterface $dataPersistor
//        ImageUploader $imageUploader
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->artifactRepository = $artifactRepository;
        $this->artifactsFactory = $artifactsFactory;
//        $this->imageUploader = $imageUploader;
        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        /** @var HttpRequest $request */
        $request = $this->getRequest();
        $data = $request->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam(ArtifactsInterface::ENTITY_ID);
            if (empty($data[ArtifactsInterface::ENTITY_ID])) {
                $data[ArtifactsInterface::ENTITY_ID] = null;
            }

            if ($id) {
                try {
                    /** @var ArtifactsInterface $model */
                    $model = $this->artifactRepository->getById($id);
                } catch (NoSuchEntityException $e) {
                    $this->messageManager->addErrorMessage(__($e->getMessage()));
                    /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                    $resultRedirect = $this->resultRedirectFactory->create();
                    return $resultRedirect->setPath('*/*/');
                }
            } else {
                /** @var ArtefactsModel $model */
                $model = $this->artifactsFactory->create();
            }
//            $this->processImage($data);
            $model->setData($data);

            try {
                $this->artifactRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the artifact.'));
                $this->dataPersistor->clear('artifact');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', [ArtifactsInterface::ENTITY_ID => $model->getId()]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (CouldNotSaveException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the artifact.'));
            }

            $this->dataPersistor->set('artifact', $data);
            return $resultRedirect->setPath('*/*/edit', [ArtifactsInterface::ENTITY_ID => $id]);
        }

        return $resultRedirect->setPath('*/*/');
    }

//    /**
//     * @return array
//     */
//    private function processImage(&$data)
//    {
//        $this->filePreprocessing($data, 'logo');
//        $this->filterFileData($data, 'logo');
//        $this->moveImage($data, 'logo');
//    }
//
//    /**
//     * @param array $data
//     * @param string $fieldName
//     */
//    private function filterFileData(&$data, $fieldName)
//    {
//        if (isset($data[$fieldName]) && is_array($data[$fieldName])) {
//            if (!empty($data[$fieldName]['delete'])) {
//                $data[$fieldName] = null;
//            } else {
//                if (isset($data[$fieldName][0]['name']) && isset($data[$fieldName][0]['tmp_name'])) {
//                    $data[$fieldName] = $data[$fieldName][0]['name'];
//                } else {
//                    unset($data[$fieldName]);
//                }
//            }
//        }
//    }

//    /**
//     * @param array $data
//     * @param string $fieldName
//     */
//    private function filePreprocessing(&$data, $fieldName)
//    {
//        if (empty($data[$fieldName])) {
//            unset($data[$fieldName]);
//            $data[$fieldName]['delete'] = true;
//        }
//    }
//
//    /**
//     * @param array $data
//     * @param string $fieldName
//     */
//    private function moveImage(&$data, $fieldName)
//    {
//        if ($data[$fieldName]) {
//            $this->imageUploader->moveFileFromTmp($data[$fieldName]);
//        }
//    }
}