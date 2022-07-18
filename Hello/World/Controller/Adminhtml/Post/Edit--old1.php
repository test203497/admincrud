<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Hello\World\Controller\Adminhtml\Post;
class Edit extends \Magento\Backend\App\Action
{
  protected $resultPageFactory = false;
  public function __construct(
   \Magento\Backend\App\Action\Context $context,
   \Magento\Framework\View\Result\PageFactory $resultPageFactory
  )
  {
    parent::__construct($context);
    $this->resultPageFactory = $resultPageFactory;
   }
  public function execute()
  {
   $resultPage = $this->resultPageFactory->create();
   $resultPage->getConfig()->getTitle()->prepend((__('Edit')));
   return $resultPage;
  }
}
