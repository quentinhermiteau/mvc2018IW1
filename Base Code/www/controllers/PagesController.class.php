<?php

declare(strict_types=1);

namespace Controllers;

use Models\View;

class PagesController
{
    public function defaultAction(): void
    {
        $view = new View('homepage', 'back');
    }
}
