<?php

interface ProductAdjustmentInterface
{
    public function adjust();
}

class ProductAdjustment implements ProductAdjustmentInterface
{
    public function __construct(
        ProductAdjustment $product = null
    )
    {
        $this->product = null;
    }

    public function adjust()
    {
        try {
            if ($this->product == null) {
                throw new Exception("Product is not set \n");
            }
            $this->product->adjust();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

    }

    public function setProduct($product)
    {
        $this->product = $product;
    }


}

abstract class ProductAdjustmentAbstract implements ProductAdjustmentInterface
{
    public function __call(string $name, array $arguments)
    {
        if ($name == 'adjustQty') {
            echo "Set qty to $arguments[0] \n";
        }
    }
}
class SimpleProductAdjustment extends ProductAdjustmentAbstract
{
    public function adjust()
    {
        $this->adjustQty(1);
    }
}
class BundleProductAdjustment extends ProductAdjustmentAbstract
{

    public function adjust()
    {
        $this->adjustQty(3);
    }
}
class ConfigurableProductAdjustment extends ProductAdjustmentAbstract
{

    public function adjust()
    {
        $this->adjustQty(2);
    }
}

$productAdjustment = new ProductAdjustment();
$productAdjustment->adjust();

$productAdjustment->setProduct(new SimpleProductAdjustment());

$productAdjustment->adjust();

$productAdjustment->setProduct(new BundleProductAdjustment());

$productAdjustment->adjust();

$productAdjustment->setProduct(new ConfigurableProductAdjustment());

$productAdjustment->adjust();