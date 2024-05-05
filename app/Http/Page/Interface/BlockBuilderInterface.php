<?php

namespace App\Http\Page\Interface;

interface BlockBuilderInterface
{
    public function buildHeader();
    public function buildNavigation();

    public function buildBody($body);

    public function buildFooter();

    public function buildNotification();

    public function buildAdminPage();
}