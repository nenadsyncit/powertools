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
class Categories extends \Magento\Framework\View\Element\Template
{

    protected $_categoryCollectionFactory;
    protected $_categoryHelper;
    public $allCategories;
    public $registry;
    private $serializer;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        \Magento\Catalog\Helper\Category $categoryHelper,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Serialize\SerializerInterface $serializer,
        array $data = []
    ) {
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
        $this->_categoryHelper = $categoryHelper;
        $this->registry = $registry;
        $this->serializer = $serializer;
        parent::__construct($context, $data);
    }

    public function getCategoryCollection($isActive = true, $level = false, $sortBy = false, $pageSize = false)
    {
        $collection = $this->_categoryCollectionFactory->create();
        $collection->addAttributeToSelect('*');

        // select only active categories
        if ($isActive) {
            $collection->addIsActiveFilter();
        }

        // select categories of certain level
        if ($level) {
            $collection->addLevelFilter($level);
        }

        // sort categories by some value
        if ($sortBy) {
            $collection->addOrderField($sortBy);
        }

        // set pagination
        if ($pageSize) {
            $collection->setPageSize($pageSize);
        }

        return $collection;
    }

    public function getStoreCategories($sorted = false, $asCollection = false, $toLoad = true)
    {
        return $this->_categoryHelper->getStoreCategories($sorted = false, $asCollection = false, $toLoad = true);
    }

    /**
     * Get all categories. This method is getting all subcategories too.
     *
     * @return array allcategories;
     *
     */
    public function getAllCategories()
    {
        $categories = $this->getCategoryCollection();
        foreach ($categories as $category) {
            $this->allCategories[] = [
                'id' => $category->getId(),
                'name' => $category->getName(),
                'url' => $category->getUrl(),
                'type' => 'category',

            ];
        }

        return $this->allCategories;
    }/**
     * Dump info
     *
     * @return void
     */
    public function dumpAllCategories()
    {
        return var_dump($this->getAllCategories());
    }
    /**
     * Get current category ID
     *
     * @return string $id;
     */
    public function getCurrentCategoryId()
    {
        $category = $this->registry->registry('current_category');
        $categoryId = $category->getId();
        return $categoryId;
    }
    /**
     * Get current category name
     *
     * @return string $categoryName
     */
    public function getCurrentCategoryName()
    {
        $category = $this->registry->registry('current_category');
        $categoryName = $category->getName();
        return $categoryName;
    }
    /**
     * Get current category url
     *
     * @return string $categoryUrl
     */
    public function getCurrentCategoryUrl()
    {
        $category = $this->registry->registry('current_category');
        $categoryUrl = $category->getUrl();
        return $categoryUrl;
    }
    public function getCurrentCategoryInfo(){
        $data = array(
            'id'=>$this->getCurrentCategoryId(),
            'name'=>$this->getCurrentCategoryName(),
            'url'=>$this->getCurrentCategoryUrl()   
        );
        return $data;
    }
    public function getAllCategoriesUrl()
    {
        $this->getAllCategories();
        $data = $this->allCategories;
        $url=[];       
        foreach ($data as $item){
            $url[] = $item['url'];
        }
        
        return $url; 
       
    }

}
