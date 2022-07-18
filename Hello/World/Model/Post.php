<?php
namespace Hello\World\Model;
class Post extends \Magento\Framework\Model\AbstractModel implements \Hello\World\Api\Data\PostInterface
{
  const CACHE_TAG = 'hw_record';
  protected $_cacheTag = 'hw_record';
  protected $_eventPrefix = 'hw_record';
  protected function _construct()
  {
    $this->_init('Hello\World\Model\ResourceModel\Post');
  }
  public function getPostId(){
    return $this->getData(self::POST_ID);
  }
  public function setPostId($postId){
    return $this->setData(self::POST_ID, $postId);
  }
  public function getName()
  {
    return $this->getData(self::NAME);
  }
  public function setName($name)
  {
    return $this->setData(self::NAME,$name);
  }
  public function getStatus(){
    return $this->getData(self::STATUS);
  }
  public function setStatus($status)
  {
    return $this->setData(self::STATUS,$status);
  }
  public function getCreated_At()
  {
      return $this->getData(self::CREATED_AT);
  }
  public function setCreated_At($created_At)
  {
    return $this->setData(self::CREATED_AT,$created_At);
  }
  public function getUpdated_At()
  {
    return $this->getData(self::UPDATED_AT);
  }
  public function setUpdated_At($updated_At)
  {
   return $this->setData(self::UPDATED_AT,$updated_At);
  }
}
