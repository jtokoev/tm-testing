<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: '`user`')]
class Member
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\OneToMany(mappedBy: 'member', targetEntity: MemberResponse::class, cascade: ['persist'])]
    private Collection $memberResponses;

    public function __construct()
    {
        $this->name = uniqid('user_');
        $this->memberResponses = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function addMemberResponse(MemberResponse $memberResponse): self
    {
        if (!$this->memberResponses->contains($memberResponse)) {
            $this->memberResponses->add($memberResponse);
            $memberResponse->setMember($this);
        }

        return $this;
    }
}
