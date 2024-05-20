<?php

interface ElementsBuilder
{
    public function buildRawElements();

    public function buildCssStyles();

    public function buildAdvancedElements();
}

class BlockBuilder implements ElementsBuilder
{

    private Block $block;

    public function __construct()
    {
        $this->reset();
    }

    public function buildRawElements()
    {
        $this->block->elements[] = '<a href="asd">Raw link</a>';
    }

    public function buildCssStyles()
    {
        $this->block->elements[] = '<style></style>';
    }

    public function buildAdvancedElements()
    {
        $this->block->elements[] = '<scrpit></scrpit>';
    }

    private function reset()
    {
        $this->block = new Block();
    }

    public function getBlock(): Block
    {
        $result = $this->block;

        $this->reset();

        return $result;
    }
}

class Block
{
    public array $elements = [];

    public function renderElements()
    {
        echo "Block parts: " . implode(', ', $this->elements) . PHP_EOL;
    }
}

class Director
{
    private ElementsBuilder $builder;

    public function setBuilder(ElementsBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function buildMinimalViableProduct()
    {
        $this->builder->buildRawElements();
        $this->builder->getBlock()->renderElements();
    }

    public function buildFullFeaturedProduct()
    {
        $this->builder->buildRawElements();
        $this->builder->buildCssStyles();
        $this->builder->buildAdvancedElements();
        $this->builder->getBlock()->renderElements();

    }

}
$director = new Director();
$builder = new BlockBuilder();
$director->setBuilder($builder);

$director->buildMinimalViableProduct();
$director->buildMinimalViableProduct();
$director->buildMinimalViableProduct();

$director->buildFullFeaturedProduct();
$director->buildFullFeaturedProduct();
$director->buildFullFeaturedProduct();

echo "Custom build:\n";
$builder->buildRawElements();
$builder->getBlock()->renderElements();
