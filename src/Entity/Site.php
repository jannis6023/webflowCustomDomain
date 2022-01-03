<?php

namespace App\Entity;

use App\Repository\SiteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SiteRepository::class)
 */
class Site
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $host;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $webflowAddress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $redirectURL;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHost(): ?string
    {
        return $this->host;
    }

    public function setHost(string $host): self
    {
        $this->host = $host;

        return $this;
    }

    public function getWebflowAddress(): ?string
    {
        return $this->webflowAddress;
    }

    public function setWebflowAddress(string $webflowAddress): self
    {
        $this->webflowAddress = $webflowAddress;

        return $this;
    }

    public function getRedirectURL(): ?string
    {
        return $this->redirectURL;
    }

    public function setRedirectURL(?string $redirectURL): self
    {
        $this->redirectURL = $redirectURL;

        return $this;
    }
}
