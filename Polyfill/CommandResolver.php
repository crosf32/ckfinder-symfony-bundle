<?php

namespace CKSource\Bundle\CKFinderBundle\Polyfill;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface;

/**
 * Class CommandResolver
 *
 * @deprecated
 */
class CommandResolver extends \CKSource\CKFinder\CommandResolver implements ArgumentResolverInterface {
    public function getArguments(Request $request, callable $controller): array
    {
        return [];
    }
}
