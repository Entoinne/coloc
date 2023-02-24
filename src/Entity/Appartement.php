<?php

namespace App\Entity;

use App\Repository\AppartementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppartementRepository::class)]
class Appartement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $address = null;

    #[ORM\OneToMany(mappedBy: 'appartementId', targetEntity: Room::class, orphanRemoval: true)]
    private Collection $rooms;

    #[ORM\OneToMany(mappedBy: 'appartementId', targetEntity: User::class)]
    private Collection $roomates;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
        $this->roomates = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection<int, Room>
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Room $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms->add($room);
            $room->setAppartementId($this);
        }

        return $this;
    }

    public function removeRoom(Room $room): self
    {
        if ($this->rooms->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getAppartementId() === $this) {
                $room->setAppartementId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getRoomates(): Collection
    {
        return $this->roomates;
    }

    public function addRoomate(User $roomate): self
    {
        if (!$this->roomates->contains($roomate)) {
            $this->roomates->add($roomate);
            $roomate->setAppartementId($this);
        }

        return $this;
    }

    public function removeRoomate(User $roomate): self
    {
        if ($this->roomates->removeElement($roomate)) {
            // set the owning side to null (unless already changed)
            if ($roomate->getAppartementId() === $this) {
                $roomate->setAppartementId(null);
            }
        }

        return $this;
    }
}
