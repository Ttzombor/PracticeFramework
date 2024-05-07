<?php

namespace App\Http\Page;

class Block
{
    public array $elements = [];

    public function __construct(
        public $params = null
    ) {
    }

    public function renderElements()
    {
        foreach ($this->elements as $element) {
            include $element;
        }
    }
}
