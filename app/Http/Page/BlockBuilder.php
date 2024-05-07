<?php

namespace App\Http\Page;

class BlockBuilder implements \App\Http\Page\Interface\BlockBuilderInterface
{
    private Block $block;

    public function __construct(
        public $params = null
    ) {
        $this->reset();
    }

    private function reset()
    {
        $this->block = new Block($this->params);
    }

    public function getBlock(): Block
    {
        $result = $this->block;

        $this->reset();

        return $result;
    }

    public function buildFullPage($body)
    {
        $this->buildHeader();
        $this->buildNavigation();
        $this->buildNotification();
        $this->buildBody($body);
        $this->buildFooter();
    }

    public function buildAdminPage($body)
    {
        $this->buildHeader();
        $this->buildAdminNavigation();
        $this->buildNotification();
        $this->buildBody($body);
    }
    public function buildHeader()
    {
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/view/header/head.phtml")) {
            $this->block->elements[] = $_SERVER['DOCUMENT_ROOT'] . "/view/header/head.phtml";
        }
    }

    public function buildNavigation()
    {
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/view/header/navigation.phtml")) {
            $this->block->elements[] = $_SERVER['DOCUMENT_ROOT'] . "/view/header/navigation.phtml";
        }
    }

    public function buildBody($body)
    {
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/view/$body.phtml")) {
            return $this->block->elements[] = $_SERVER['DOCUMENT_ROOT'] . "/view/$body.phtml";
        }
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/view/404.phtml")) {
            return $this->block->elements[] = $_SERVER['DOCUMENT_ROOT'] . "/view/404.phtml";
        }
        return null;
    }

    public function buildFooter()
    {
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/view/footer/footer.phtml")) {
            $this->block->elements[] =  $_SERVER['DOCUMENT_ROOT'] . "/view/footer/footer.phtml";
        }
    }

    public function buildNotification()
    {
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/view/header/notifications.phtml")) {
            $this->block->elements[] =  $_SERVER['DOCUMENT_ROOT'] . "/view/header/notifications.phtml";
        }
    }

    public function buildAdminNavigation()
    {
        $this->buildNavigation();
    }
}
