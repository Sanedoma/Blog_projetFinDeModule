<?php

namespace App\Twig\Extension;

use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class QueryParamsExtension extends AbstractExtension
{
    public function __construct(private RequestStack $requestStack)
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('query_params', [$this, 'queryParams']),
        ];
    }

    public function queryParams(array $params = []): array
    {
        $request = $this->requestStack->getCurrentRequest();
        if (!$request) {
            return $params;
        }

        // Get all current query parameters
        $queryParams = $request->query->all();

        // Merge with new parameters (new ones override old ones)
        return array_merge($queryParams, $params);
    }
}
