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
 * @package   SyncIt_PowerTools
 * @author    Nenad Mihajlović <nenad@syncitgroup.com>
 * @link      https://syncitgroup.com/
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright Copyright (C) 2019 SyncIt (https://syncitgroup.com/)
 */
namespace Syncit\PowerTools\Block;


class CurrentPage extends \Magento\Framework\View\Element\Template
{


    /**
     * @var \Magento\Framework\Registry
     */
    public $coreRegistry;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Magento\Framework\Registry $coreRegistry     
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,    
        \Magento\Framework\Registry $coreRegistry,     
        array $data = []
    ) {
        $this->storeManager = $context->getStoreManager(); 
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
    }

    /**
     *  Get Controller, Module, Action & Route Name
     *
     * @return string $data
     */
    public function getCurrentPage()
    {
        $data = null;
        $data = $this->getRequest()->getFullActionName();
        return $data;
    }
    /**
     *  Get current page Id
     *
     * @return string $data
     */
    public function getCurrentPageId()
    {
        $data = null;
        $obj = $this->getRequest();
        $currentPageUrl = $obj->getPathInfo();
        $id = rtrim($currentPageUrl, "/");
        $split = explode("/", $id);
        $id = array_pop($split);
        $data = $id;
        return $data;
    }
    public function dumpCurrentPage(){
        return var_dump($this->getCurrentPage());
    }

}
