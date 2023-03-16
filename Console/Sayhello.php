<?php

namespace Bluethink\Grid\Console;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;


class Sayhello extends Command
{
    protected $state;
	protected $productFactory;


    public function __construct(
		\Magento\Framework\App\State $state,
        \Magento\Catalog\Model\ProductFactory $productFactory
        
    ) {
		
        parent::__construct();
        $this->productFactory = $productFactory;
		$this->state = $state;

    }
	
	const COPY = 'copy';
    const PRODUCTID = 'productid';

	protected function configure()
	{

		$options = [
			new InputOption(
				self::COPY,
				null,
				InputOption::VALUE_REQUIRED,
				'Copy'
            ),
            new InputOption(
				self::PRODUCTID,
				null,
				InputOption::VALUE_REQUIRED,
				'Productid'
            ),
		];

		$this->setName('product:copyproduct')
			->setDescription('Demo command line')
			->setDefinition($options);

		parent::configure();
	}
    
	protected function execute(InputInterface $input, OutputInterface $output)
	{
        $this->state->setAreaCode(\Magento\Framework\App\Area::AREA_FRONTEND);
            $totalCopies = $input->getOption(self::COPY);
            $productId=$input->getOption(self::PRODUCTID);
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
                // $geturlkey=$product->getUrlKey();
                $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // instance of object manager
                $product1 = $objectManager->create('\Magento\Catalog\Model\Product');
                // $this->state->setAreaCode(\Magento\Framework\App\Area::AREA_FRONTEND);
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
                $geturlkey=rand(10000,9999);
                $product1->setUrlKey($geturlkey);
                $product1->save();
                // $output->writeln($product1->getSku());
                // $output->writeln($product1->getId());

            }
        // return $this->_redirect('grid/grid/index');
	}

    public function getLoadProduct($id)
    {
        return $this->productFactory->create()->load($id);
    }
    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Bluethink_Grid::save');
    }

}
