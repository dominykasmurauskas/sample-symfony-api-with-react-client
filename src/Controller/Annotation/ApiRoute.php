<?php

namespace App\Controller\Annotation;

use Symfony\Component\Routing\Annotation\Route;

/**
 * @Annotation
 */
class ApiRoute extends Route
{
    /**
     * @return array<string, string>
     */
    public function getDefaults(): array
    {
        return array_merge(
            [
                '_is_api' => true,
            ],
            parent::getDefaults()
        );
    }
}
