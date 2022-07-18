<?php
namespace Hello\World\Controller\Adminhtml\Post;

use Hello\World\Model\PostFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Framework\View\Result\PageFactory;

class Save extends Actions
{
  protected $resultPageFactory;
  protected $postFactory;
  public function __construct(
    Context $context,
    PageFactory $resultPageFactory,
    PostFactory $postFactory,
    Validator $formKeyValidator
    )
    {
      $this->resultPageFactory = $resultPageFactory;
      $this->postFactory = $postFactory;
      $this->formKeyValidator = $formKeyValidator;
      parent::__construct($context);
    }
     public function execute()
     {
       $resultPageFactory = $this->resultRedirectFactory->create();
       if(!$this->formKeyValidator->validate($this->getRequest))
       {
         $this->messageManager->addErrorMessage(__("Form key is Invalidate"));
         return $resultPageFactory->setPath('*/*/index');
       }
       $data = $this->getRequest()->getPostValue();
       try{
         if($data) {
           $model = $this->postFactory->create();
           $model->setData($data)->save();
           $this->messageManager->addSuccessMessage(__("Data Save Successfully."));
           $buttondata = $this->getRequest()->getParam('back');
           if($buttondata == 'add'){
             return $resultPageFactory->setPath('*/*/form');
           }
           if($buttondata == 'close'){
             return $resultPageFactory->setPath('*/*/index');
           }
           $id = $model->getId();
           return $resultPageFactory->setPath('*/*/form', ['id' =>$id]);
         }catch (\Exception $e) {
           $this->messageManager->addErrorMessage($e, __("We can't submit your request, Please try again."));
         }
         return $resultPageFactory->setPath('*/*/index');
       }
     }
}
