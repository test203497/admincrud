<?php
namespace Hello\World\Model\ResourceModel;

class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
  public function __construct(
    \Magento\Framework\model\ResourceModel\Db\Context $context
    )
    {
      parent::__construct($context);
    }
    protected function _construct()
    {
      $this->_init('hw_record', 'post_id');
    }
}
