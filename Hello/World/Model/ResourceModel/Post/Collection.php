<?php
namespace Hello\World\Model\ResourceModel\Post;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
  protected $_idFieldName = 'post_id';
  protected $_eventPrefix = 'hw_record_collection';
  protected $_eventObject = 'post_collection';

  protected function _construct()
  {
    $this->_init('Hello\World\Model\Post','Hello\World\Model\ResourceModel\Post');
  }
}
