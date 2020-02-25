<?php
namespace Roma\Stalker\Controller\Adminhtml\Artifacts;

use Magento\Backend\App\Action as BackendAction;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

/**
* Class Index
*/
class Index extends BackendAction implements HttpGetActionInterface
{
/**
* {@inheritdoc}
*/
const ADMIN_RESOURCE = 'Roma_Test::roma_manage_artifacts';

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
parent::__construct($context);
$this->resultPageFactory = $resultPageFactory;
}

/**
* Cars list
*
* @return Page
*/
public function execute()
{
/** @var Page $resultPage */
$resultPage = $this->resultPageFactory->create();
$resultPage->setActiveMenu(self::ADMIN_RESOURCE);
$resultPage->getConfig()->getTitle()->prepend(__('My Customer Artifacts'));
$resultPage->addBreadcrumb(__('My Customer Artifacts'), __('My Customer Artifacts'));
$resultPage->addBreadcrumb(__('Customer Artifacts'), __('Customer Artifacts'));
return $resultPage;
}

/**
* @return bool
*/
protected function _isAllowed()
{
return $this->_authorization->isAllowed(static::ADMIN_RESOURCE);
}
}