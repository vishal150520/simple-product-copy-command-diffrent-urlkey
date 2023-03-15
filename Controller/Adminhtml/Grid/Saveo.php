<?php


namespace Bluethink\Grid\Controller\Adminhtml\Grid;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Bluethink\Grid\Model\GridFactory
     */
    var $gridFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Bluethink\Grid\Model\GridFactory $gridFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Bluethink\Grid\Model\GridFactory $gridFactory
    ) {
        parent::__construct($context);
        $this->gridFactory = $gridFactory;
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // instance of object manager
        $product = $objectManager->create('\Magento\Catalog\Model\Product');
        $product->setSku('f54'); // Set your sku here
        $product->setName('Sample Simple Product123'); // Name of Product
        $product->setAttributeSetId(4); // Attribute set id
        $product->setStatus(1); // Status on product enabled/ disabled 1/0
        $product->setWeight(10); // weight of product
        $product->setVisibility(4); // visibilty of product (catalog / search / catalog, search / Not visible individually)
        $product->setTaxClassId(0); // Tax class id
        $product->setTypeId('simple123'); // type of product (simple/virtual/downloadable/configurable)
        $product->setPrice(100); // price of product
        $product->setStockData(
                                array(
                                    'use_config_manage_stock' => 0,
                                    'manage_stock' => 1,
                                    'is_in_stock' => 1,
                                    'qty' => 999999999
                                )
                            );
        $product->save();
        // $data = $this->getRequest()->getPostValue();
        // if (!$data) {
        //     $this->_redirect('grid/grid/addrow');
        //     return;
        // }
       
        // try {
        //     if($data)
        //     {
        //         if($data['title']==null || $data['title']==0|| $data['title']==1 )
        //         {
        //             $data['title']=1;
        //             $randomid = mt_rand(100000,999999);  
        //             $data['content']=$randomid;
        //             // print_r($data);die();
        //         }
        //         else
        //         {
        //             $data['title']=$data['title'];
        //             $n=$data['title'];
        //             for($i=0;$i<$n;$i++)
        //             {
        //                 // $randomid = mt_rand(100000,999999); 
        //                 // echo $randomid;die();
        //                 // $array[$i] = mt_rand(100000,999999);
        //                 // $randomid= implode(",",$array);
        //                 // echo $randomid;die();
        //                 // $data['productid']=$randomid;
        //                 $random_number_array = range(100000,999999);
        //                 shuffle($random_number_array );
        //                 $random_number_array = array_slice($random_number_array ,1,$n);
        //                 $randomid= implode(",",$random_number_array);
        //                 $data['content']=$randomid;
        //                 // echo $randomid;die();
        //                 // print_r($random_number_array);die();
        //             }
                     
                    
        //         }
        //     }  
        //     $rowData = $this->gridFactory->create();
        //     $rowData->setData($data);
        //     if (isset($data['id'])) {
        //         $rowData->setEntityId($data['id']);
        //     }
        //     $rowData->save();
        //     $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
        // } catch (\Exception $e) {
        //     $this->messageManager->addError(__($e->getMessage()));
        // }
        $this->_redirect('grid/grid/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Bluethink_Grid::save');
    }
}