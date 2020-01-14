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
 *  Get all atrtributes ids and names
 */
class Attributes extends \Magento\Framework\View\Element\Template
{

    protected $_attributeFactory;

    public function __construct(
      
       \Magento\Catalog\Model\ResourceModel\Eav\Attribute $attributeFactory
      
   ) {
       
       $this->_attributeFactory = $attributeFactory;
       
   }
   /**
    * Get all attributes ids
    *
    * @return void
    */
   public function getAllAttributesIds()
   {
       $attributeInfo = $this->_attributeFactory->getCollection();
   
      foreach($attributeInfo as $attributes)
      {
           $attributeId = $attributes->getAttributeId();
           
           var_dump($attributeId );
      }
   }
   public function getAllAttributesNames()
   {
       $attributeInfo = $this->_attributeFactory->getCollection();
   
      foreach($attributeInfo as $attributes)
      {
           $attributeName = $attributes->getFrontendLabel();
           
           var_dump($attributeName );
      }
   }

}
