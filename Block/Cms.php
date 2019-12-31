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

/**
 *  Get all cms pages
 */
class Cms extends \Magento\Framework\View\Element\Template
{

    public $pages;
    public $helper;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Cms\Api\PageRepositoryInterface $pageRepositoryInterface,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Cms\Helper\Page $helper,
        array $data = []
    ) {
        $this->pageRepositoryInterface = $pageRepositoryInterface;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->helper = $helper;
        parent::__construct($context, $data);
    }
 
   /**
    * Get CMS pages
    *
    * @return void
    */
    public function getPages()
    {
        $searchCriteria = $searchCriteria = $this->searchCriteriaBuilder->create();
        $pages = $this->pageRepositoryInterface->getList($searchCriteria)->getItems();
        return $pages;
    }
    public function getAllPages()
    {
        $pages = $this->getPages();
        foreach ($pages as $page) {

            $id = $page->getId();
            $title = $page->getTitle();
            $url = $this->helper->getPageUrl($id);
            $this->pages[] = [
                'id' => $id,
                'name' => $title,
                'url' => $url,
                'type' => 'cms'
            ];
        }
        return $this->pages;
    }
    public function dumpAllPages(){
        return var_dump($this->getAllPages());
    }
}
