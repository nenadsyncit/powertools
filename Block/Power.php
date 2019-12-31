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
 *  Get categories and subcategories
 */

class Power extends \Magento\Framework\View\Element\Template
{
    public $currentPage;
    
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Syncit\PowerTools\Block\CurrentPage $currentPage,
        array $data = []
    ) {
        $this->currentPage = $currentPage;
        parent::__construct( $context, $data);
    }
    public function showCurrentPageInfo(){
        $this->currentPage->dumpCurrentPage();
    }
}
