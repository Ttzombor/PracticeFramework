<?php

class Product
{
    public function __construct(private string $name = '', private float $price = 0)
    {
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getName()
    {
        return $this->name;
    }
}
class ProductCollection implements \IteratorAggregate
{
    private $products = [];
    public function getIterator()
    {
        return new ProductsIterator($this);
    }

    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    public function getProduct($position)
    {
        return $this->products[$position];
    }

    public function exists($position)
    {
        return isset($this->products[$position]) ? true : false;
    }
}

class ProductsIterator implements Iterator
{
    private int $position;

    public function __construct(private IteratorAggregate $collection)
    {
    }

    public function current(): mixed
    {
        return $this->collection->getProduct($this->key());
    }

    public function next(): void
    {
        $this->position++;
    }

    public function key(): mixed
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return $this->collection->exists($this->position);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }
}

class Cart
{
    public function __construct(private Iterator $collection)
    {
    }

    public function collect()
    {
        $sum = 0;
        foreach ($this->collection as $product) {
            $sum += $product->getPrice();
        }
        return $sum;
    }
}

class ProductsFilterByExotic extends FilterIterator
{
    public function accept()
    {
        $product = $this->current();
        if ($product->getName() == 'Banana') {
            return true;
        }
        return false;
    }
}



$productCollection = new ProductCollection();

$productCollection->addProduct(new Product('Apple', 1.99));
$productCollection->addProduct(new Product('Banana', 0.99));
$productCollection->addProduct(new Product('Cherry', 2.99));

$cart = new Cart($productCollection->getIterator());
$cartTotal = $cart->collect();
echo $cartTotal . PHP_EOL;

$filterIterator = new ProductsFilterByExotic($productCollection->getIterator());
$cart = new Cart($filterIterator);
$cartTotal = $cart->collect();
echo $cartTotal . PHP_EOL;

$limitIterator = new LimitIterator($productCollection->getIterator(), 0, 2);
$cart = new Cart($limitIterator);
$cartTotal = $cart->collect();
echo $cartTotal;