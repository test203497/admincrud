<?php
namespace Hello\World\Controller\Adminhtml\Post;

use Hello\World\Model\PostFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
class Delete extends Action
{
  protected $resultPageFactory;
  protected $postFactory;

  public function __construct(
     Context $context,
     PageFactory $resultPageFactory,
     PostFactory $postFactory
    )
    {
      $this->resultPageFactory = $resultPageFactory;
      $this->postFactory = $postFactory;
      parent::__construct($context);
    }
    public function execute()
    {
      $resultRedirectFactory = $this->resultRedirectFactory->create();
      $id = $this->getRequest()->getParam('post_id');
      $model = $this->postFactory->create()->load($id);
      if($model->getPostId()){
          $model->delete();
          $this->messageManager->addSuccessMessage(__("Record Delete Successfully."));
        }else{
          $this->messageManager->addErrorMessage(__("Something went wrong, Please try again."));
          }
         return $resultRedirectFactory->setPath('*/*/index');
         }
}
