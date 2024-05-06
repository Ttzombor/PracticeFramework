<?php

namespace App\Http\Page;

class Block
{
    public array $elements = [];

    public function renderElements()
    {
        foreach ($this->elements as $element) {
            require_once  $element;
        }
    }
}
