<?php 
namespace Syncit\PowerTools\Model\ResourceModel\Data;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;


class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
        'Syncit\PowerTools\Model\Data',
        'Syncit\PowerTools\Model\ResourceModel\Data'
    );
    }
}