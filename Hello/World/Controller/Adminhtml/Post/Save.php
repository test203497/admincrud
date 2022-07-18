<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 *
 * Created By : Rohan Hapani
 */
namespace Hello\World\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use Hello\World\Model\Post;

class Save extends \Magento\Backend\App\Action
{

    /**
     * @var Blog
     */
    protected $postFactory;

    /**
     * @var Session
     */
    protected $adminsession;

     public function __construct(
        Action\Context $context,
        Post $postFactory,
        Session $adminsession
    ) {
        parent::__construct($context);
        $this->postFactory = $postFactory;
        $this->adminsession = $adminsession;
    }

    /**
     * Save blog record action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            $blog_id = $this->getRequest()->getParam('post_id');
            if ($blog_id) {
                $this->postFactory->load($blog_id);
            }

            $this->postFactory->setData($data);

            try {
                $this->postFactory->save();
                $this->messageManager->addSuccess(__('The data has been saved.'));
                $this->adminsession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    if ($this->getRequest()->getParam('back') == 'add') {
                        return $resultRedirect->setPath('*/*/add');
                    } else {
                        return $resultRedirect->setPath('*/*/edit', ['blog_id' => $this->postFactory->getId(), '_current' => true]);
                    }
                }

                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['blog_id' => $this->getRequest()->getParam('post_id')]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
