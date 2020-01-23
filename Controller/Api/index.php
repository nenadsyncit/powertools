<?php
/**
 * SyncIt Group
 *
 * This source file is subject to the SyncIt Software License, which is available at https://syncitgroup.com/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  SyncIt
 * @package   Syncit_PowerTools
 * @author    Nenad Mihajlović <nenad@syncitgroup.com>
 * @link      https://syncitgroup.com/
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright Copyright (C) 2019 SyncIt (https://syncitgroup.com/)
 */

namespace Syncit\PowerTools\Controller\Api;

use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;
    protected $resultJsonFactory;

    public function __construct(
        Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory   

    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory    = $resultJsonFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        
        $result = $this->resultJsonFactory->create();
 
        $data = [
            'foo' =>'bar',
            'success' => true
        ];
 
        $result->setData($data);
 
        return $result;
         
    }

}
