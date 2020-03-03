<?php
namespace Roma\Stalker\Controller\Adminhtml\Artifacts;

use Magento\Backend\App\Action as BackendAction;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Roma\Stalker\Api\Data\ArtifactsInterface;
use Roma\Stalker\Api\ArtifactsRepositoryInterface;

/**
 * Class InlineEdit
 */
class InlineEdit extends BackendAction implements HttpPostActionInterface
{
    /**
     * {@inheritdoc}
     */
    const ADMIN_RESOURCE = 'Roma_Test::artifacts_inline_edit';

    /**
     * @var JsonFactory
     */
    private $jsonFactory;

    /**
     * @var ArtifactsRepositoryInterface
     */
    private $artifactRepository;

    /**
     * @param Context $context
     * @param ArtifactsRepositoryInterface $artifactRepository
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        ArtifactsRepositoryInterface $artifactRepository,
        JsonFactory $jsonFactory
    ) {
        $this->artifactRepository = $artifactRepository;
        $this->jsonFactory = $jsonFactory;
        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (empty($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $id) {
                    try {
                        /** @var ArtifactsInterface $model */
                        $model = $this->artifactRepository->getById($id);
                        $model->setData(array_merge($model->getData(), $postItems[$id]));
                        $this->artifactRepository->save($model);
                    } catch (NoSuchEntityException $e) {
                        $messages[] = $e->getMessage();
                        $error = true;
                    } catch (CouldNotSaveException $e) {
                        $messages[] = $e->getMessage();
                        $error = true;
                    } catch (\Exception $e) {
                        $messages[] = $e->getMessage();
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}