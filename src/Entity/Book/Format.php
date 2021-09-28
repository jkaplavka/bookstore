<?php

declare(strict_types = 1);

namespace App\Entity\Book;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Book\FormatRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    collectionOperations: [
        'get' => [
            'normalization_context' => [
                'groups' => ['format:read'],
            ],
        ],
    ],
    itemOperations: [
        'get',
    ],
)]
#[ORM\Entity(
    repositoryClass: FormatRepository::class
)]
class Format
{

    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    #[Groups(['format:read', 'book:read'])]
    private UuidInterface $id;

    #[Assert\NotBlank()]
    #[Assert\Length(min: 2, max: 50)]
    #[Groups(['format:read', 'book:read'])]
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
