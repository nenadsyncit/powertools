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
 *  Images helper
 */
class Images extends \Magento\Framework\View\Element\Template
{

 protected $product;

    public function __construct(
      
        \Magento\Catalog\Model\Product $product
      
   ) {
       
       $this->product = $product;
       
   }

   public function getAllImagesUrls(){
       // load image for product id
    $product = $this->product->load(12);
    $images = $product->getMediaGalleryImages(); 
    foreach($images as $image){
        var_dump($image->getUrl());
    }
   }
    
}
