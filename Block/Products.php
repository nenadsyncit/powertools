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

namespace Syncit\PowerTools\Block;

class Products extends \Magento\Framework\View\Element\Template
{
    public $productRepository;
    public $criteria;
    public $filterGroup;
    public $filterBuilder;
    public $productStatus;
    public $productVisibility;
    public $productItems;
    public $model;
    // collection
    public $productCollectionFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = [],
        // Repository
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Framework\Api\SearchCriteriaInterface $criteria,
        \Magento\Framework\Api\Search\FilterGroup $filterGroup,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Magento\Catalog\Model\Product\Attribute\Source\Status $productStatus,
        \Magento\Catalog\Model\Product\Visibility $productVisibility,
        // Collection
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Syncit\PowerTools\Model\Data $model
    ) {
        parent::__construct($context, $data);
        // Repository
        $this->productRepository = $productRepository;
        $this->searchCriteria = $criteria;
        $this->filterGroup = $filterGroup;
        $this->filterBuilder = $filterBuilder;
        $this->productStatus = $productStatus;
        $this->productVisibility = $productVisibility;
        $this->model = $model;
        // Collection
        $this->productCollectionFactory = $productCollectionFactory;

    }
/**
 * Get products using Repository
 *
 * @return $productItems
 */
    public function getProductData()
    {

        $this->filterGroup->setFilters([
            $this->filterBuilder
                ->setField('status')
                ->setConditionType('in')
                ->setValue($this->productStatus->getVisibleStatusIds())
                ->create(),
            $this->filterBuilder
                ->setField('visibility')
                ->setConditionType('in')
                ->setValue($this->productVisibility->getVisibleInSiteIds())
                ->create(),
        ]);

        $this->searchCriteria->setFilterGroups([$this->filterGroup]);
        $products = $this->productRepository->getList($this->searchCriteria);
        $productItems = $products->getItems();
        $this->productItems = $productItems;
        return $productItems;
    }
    /**
     * Get products using collection
     *
     * @return $collection
     */
    public function getProducts()
    {
        /** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $collection */
        $collection = $this->productCollectionFactory->create();
        $collection->joinAttribute('status', 'catalog_product/status', 'entity_id', null, 'inner');
        $collection->joinAttribute('visibility', 'catalog_product/visibility', 'entity_id', null, 'inner');
        $collection->addAttributeToFilter('status', ['in' => $this->productStatus->getVisibleStatusIds()])
            ->addAttributeToFilter('visibility', ['in' => $this->productVisibility->getVisibleInSiteIds()]);

        $productItems = $collection->getItems();
        $this->productItems = $productItems;
        //return $productItems;
        return;
    }
    /**
     * Get all products URL using collection
     *
     * @return array $url
     */
    public function getAllProductsUrl()
    {
        $this->getProducts();
        $data = $this->productItems;
        $url = [];
        foreach ($data as $item) {
            $url[] = $item->getProductUrl();
        }
        return count($url);
    }
    /**
     * Get all products URL using Repository
     *
     * @return array $url
     */
    public function getAllProductsUrlRepo()
    {
        $this->getProductData();

        $data = $this->productItems;
        $url = [];
        foreach ($data as $item) {
            $url[] = $item->getProductUrl();
        }
        return count($url);
    }
    /**
     * Get all products urls from table using Model
     *
     * @return array $url
     */
    public function getDatas()
    {
        $Datas = $this->model->getCollection();
        $allUrl= $Datas->getData();
        $url=[];
        foreach($allUrl as $item){
            $url [] = 
                $item['request_path'];
            
        }
        return $url;
    }
}
