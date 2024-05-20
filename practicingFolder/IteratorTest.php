<?php

class ItemIterator implements \Iterator
{
    private $collection;

    private $position = 0;

    public function __construct(
        $collection,
        $reverse = false
    )
    {
        $this->collection = $collection;
        $this->reverse = $reverse;
    }

    public function current(): mixed
    {
        return $this->collection->getItems()[$this->position];
    }

    public function next(): void
    {

        $this->position = $this->position + ($this->reverse ? -1 : 1);

    }

    public function key(): mixed
    {
        if ($this->valid() && $this->current()['isImportant'] == false) {
            $this->next();
            $this->key();
        }
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->collection->getItems()[$this->position])
            && isset($this->collection->getItems()[$this->position]['isImportant']);
    }

    public function rewind(): void
    {
        $this->position = $this->reverse ?
            count($this->collection->getItems()) - 1 : 0;
    }

}



class BlocksCollection
{
    private $items = [];

    public function addItem($item, $isImportant = false)
    {
        $this->items[] = [
            'item' => $item,
            'isImportant' => $isImportant
        ];
    }

    public function getItems()
    {
        return $this->items;
    }
    public function getIterator()
    {
        return new ItemIterator($this);
    }

    public function getReverseIteration()
    {
        return new ItemIterator($this, true);
    }
}

$collection = new BlocksCollection();
$collection->addItem('Item 1', false);
$collection->addItem('Item 2', true);
$collection->addItem('Item 3');
$collection->addItem('Item 4');
$collection->addItem('Item 5');
$collection->addItem('Item 6', true);
$collection->addItem('Item 7');
$collection->addItem('Item 8');
$collection->addItem('Item 9');

$iterator = $collection->getIterator();
while ($iterator->valid()) {
    $key = $iterator->key();
    print_r($iterator->current());
    $iterator->next();
}
//foreach ($collection->getIterator() as $key => $item) {
//    print_r($item);
//    if ($key === 3) {
//        break;
//    }
//}
//echo $collection->getIterator()->current();
//foreach ($collection->getReverseIteration() as $item) {
//    echo $item . PHP_EOL;
//}