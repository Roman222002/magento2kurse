<?php
namespace Roma\Game\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Cars
 */
class CheckGame extends Action
{
    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        $post = (array)$this->getRequest()->getPost();
        $resultPage = $this->resultPageFactory->create();

        if (!empty($post)) {
            // Retrieve your form data
            $checkGame = $post['checkGame'];
            // Display the succes form validation message
            $this->messageManager->addSuccessMessage('Checking...');

            // Redirect to your form page (or anywhere you want...)
            //$resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
           // $resultRedirect->setUrl('/game-route/index/checkgame');
           // return $resultRedirect;
            $resultPage->getLayout()
                ->getBlock('custom.check.games.block')->setGameId($checkGame);
        }
        // 2. GET request : Render the booking page
        //$this->_view->loadLayout();
        // $this->_view->renderLayout();
        return $resultPage;

    }
}