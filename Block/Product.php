<?php
namespace Bluethink\Grid\Block;
class Product extends \Magento\Framework\View\Element\Template
{
 /**
 * Constructor
 *
 * @param \Magento\Framework\View\Element\Template\Context $context
 * @param array $data
 */
 public function __construct(
 \Magento\Framework\View\Element\Template\Context $context,
 \Magento\Catalog\API\ProductRepositoryInterface $productRepository,
 array $data = []
 ) {
 $this->productRepository = $productRepository;
 parent::__construct($context, $data);
 }
/**
 * Get Product by Id
 * @param int
 * @return \Magento\Catalog\Model\Product $product
 */
 public function getProduct($id)
 {
 return $this->productRepository->getById($id);
 }
}