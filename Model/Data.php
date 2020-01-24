<?php
namespace Syncit\PowerTools\Model;

use Magento\Framework\Model\AbstractModel;

    class Data extends AbstractModel
    {   
        protected function _construct()
        {
            $this->_init('Syncit\PowerTools\Model\ResourceModel\Data');
        }
    }