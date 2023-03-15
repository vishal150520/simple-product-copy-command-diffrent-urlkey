<?php


namespace Bluethink\Grid\Controller\Adminhtml\Grid;

class Save extends \Magento\Backend\App\Action
{
    
    var $gridFactory;

    protected $productFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Catalog\Model\ProductFactory $productFactory

    ) {
        parent::__construct($context);
        $this->productFactory = $productFactory;
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $productId = $data['Product_id'];
        $totalCopies = $data['Size'];
        for($i=0;$i<$totalCopies;$i++)
        {
        $product = $this->getLoadProduct($productId);
        $productName = $product->getName();
        $attributeSetId = $product->getAttributeSetId();
        $status=$product->getStatus();
        $weight=$product->getWeight();
        $visibility=$product->getVisibility();
        $taxClassId=$product->getTaxClassId();
        $typeId=$product->getTypeId();
        $price=$product->getPrice();
        $stockData=$product->getStockData();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // instance of object manager
        $product1 = $objectManager->create('\Magento\Catalog\Model\Product');
        
        $product1->setSku('w34'); // Set your sku here
        $product1->setName($productName); // Name of Product
        $product1->setAttributeSetId($attributeSetId); // Attribute set id
        $product1->setStatus($status); // Status on product enabled/ disabled 1/0
        $product1->setWeight($weight); // weight of product
        $product1->setVisibility($visibility); // visibilty of product (catalog / search / catalog, search / Not visible individually)
        $product1->setTaxClassId($taxClassId); // Tax class id
        $product1->setTypeId($typeId); // type of product (simple/virtual/downloadable/configurable)
        $product1->setPrice($price); // price of product
        $product1->setStockData(
                                array(
                                    'use_config_manage_stock' => 0,
                                    'manage_stock' => 1,
                                    'is_in_stock' => 1,
                                    'qty' => 99
                                )
                            );
        $product1->save();
        }
        $this->_redirect('grid/grid/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Bluethink_Grid::save');
    }

    public function getLoadProduct($id)
    {
        return $this->productFactory->create()->load($id);
    }
}