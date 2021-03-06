<?php

declare(strict_types = 1);

namespace App\Twig;

use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class SerializerExtension extends AbstractExtension
{

    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('jsonld', [$this, 'serializeToJsonLd'], ['is_safe' => ['html']]),
        ];
    }

    public function serializeToJsonLd($data, array $groups = []): string
    {
        return $this->serializer->serialize($data, 'jsonld', [AbstractNormalizer::GROUPS => $groups]);
    }

}
