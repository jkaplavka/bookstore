<?php

declare(strict_types = 1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['category:read'],
            ],
        ],
    ],
    itemOperations: [
        'get',
    ],
    normalizationContext:[
        'groups' => ['category:read'],
        'swagger_definition_name' => 'Read',
    ],
    denormalizationContext:[
        'groups' => ['category:write'],
        'swagger_definition_name' => 'Write',
    ]
)]
#[ORM\Entity(
    repositoryClass: CategoryRepository::class
)]
class Category
{

    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[Groups(['category:read', 'book:read'])]
    private UuidInterface $id;

    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 50)]
    #[Groups(['category:read', 'book:read'])]
    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

}
