<?php 
namespace Syncit\PowerTools\Model\ResourceModel;
use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Data extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('url_rewrite', 'url_rewrite_id'); //id is a primary key 
    }
}