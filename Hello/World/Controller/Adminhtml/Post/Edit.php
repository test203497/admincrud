<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Hello\World\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Edit extends \Magento\Backend\App\Action
{
    /**
         * Authorization level of a basic admin session
         *
         * @see _isAllowed()
         */
        const ADMIN_RESOURCE = 'Hello_World::post';

        /**
         * @var \Magento\Framework\Registry
         */
        private $coreRegistry;

        /**
         * @var \Vendor\Modulename\Model\EntityFactory
         */
        private $postFactory;

        /**
         * @param \Magento\Backend\App\Action\Context $context
         * @param \Magento\Framework\Registry $coreRegistry,
         * @param \Vendor\Modulename\Model\PostFactory $postFactory
         */
        public function __construct(
            \Magento\Backend\App\Action\Context $context,
            \Magento\Framework\Registry $coreRegistry,
            \Hello\World\Model\PostFactory $postFactory
        ) {
            parent::__construct($context);
            $this->coreRegistry = $coreRegistry;
            $this->postFactory = $postFactory;
        }


        public function execute()
        {
            $rowId = (int) $this->getRequest()->getParam('post_id');
            $rowData = $this->postFactory->create();
             if ($rowId) {
                $rowData = $rowData->load($rowId);

                if (!$rowData->getPostId()) {
                    $this->messageManager->addError(__('row data no longer exist.'));
                    $this->_redirect('*/*/index');
                    return;
                }
            }

            $this->coreRegistry->register('row_data', $rowData);
            $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            $resultPage->setActiveMenu('Hello_World::first_level_menu');
            $title = "Post Information";
            $resultPage->getConfig()->getTitle()->prepend($title);
            return $resultPage;
        }
 }
