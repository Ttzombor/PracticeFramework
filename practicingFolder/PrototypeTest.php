<?php



class Seller
{
    public function __construct(
        private string $name,
        private array $products = []
    )
    {
    }

    public function addProduct($product)
    {
        $this->products[] = $product;
    }

    public function getProducts()
    {
        return $this->products;
    }

}

class Product
{
    private string $name;

    private string $sku;

    private int $price;

    private $timeCreated;

    public function __construct(
        string $name, int $price, private Seller $seller
    )
    {
        $this->name = $name;
        $this->price = $price;
        $this->sku = uniqid($name);
        $this->seller->addProduct($this);
        $this->timeCreated = new \DateTime();
    }

    public function __clone()
    {
        $this->name = 'Copy of ' . $this->name;
        $this->seller->addProduct($this);
        $this->sku = uniqid($this->name);
        $this->timeCreated = new \DateTime();
    }
}

$seller = new Seller("Seller 1");

$product1 = new Product("Product 1", 100, $seller);
$product2 = new Product("Product 2", 150, $seller);

$product3 = clone $product2;
print_r($product3);
var_dump($seller->getProducts());