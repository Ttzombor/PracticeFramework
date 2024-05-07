<?php

namespace App\Http\Page;

class PageBuilder
{
    private BlockBuilder $blockBuilder;

    private function setBuilder(BlockBuilder $blockBuilder)
    {
        $this->blockBuilder = $blockBuilder;
    }

    private function buildPage($page)
    {
        $this->blockBuilder->buildFullPage($page);
        $this->blockBuilder->getBlock()->renderElements();
    }

    private function buildAdminPage($page)
    {
        $this->blockBuilder->buildAdminPage($page);
        $this->blockBuilder->getBlock()->renderElements();
    }

    public function __invoke($page, $params = null)
    {
        $builder = new BlockBuilder($params);
        $this->setBuilder($builder);
        if ($page && str_contains($page, 'user')) {
            $this->buildAdminPage($page);
        } else {
            $this->buildPage($page);
        }

    }

}
