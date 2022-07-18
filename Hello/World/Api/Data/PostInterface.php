<?php
namespace Hello\World\Api\Data;

interface PostInterface
{
  const POST_ID = 'post_id';
  const NAME = 'name';
  const STATUS = 'status';
  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';

  public function getPostId();
  public function setPostId($postId);
  public function getName();
  public function setName($name);
  public function getStatus();
  public function setStatus($status);
  public function getCreated_At();
  public function setCreated_At($created_At);
  public function getUpdated_At();
  public function setUpdated_At($updated_At);
}
