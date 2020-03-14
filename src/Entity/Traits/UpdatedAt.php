<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait UpdatedAt
{
    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime();
    }
}