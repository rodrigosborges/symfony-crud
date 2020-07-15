<?php

namespace App\Entity;

use App\Repository\MarcaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarcaRepository::class)
 */
class Marca
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nome;

    /**
     * @ORM\OneToMany(targetEntity=Modelo::class, mappedBy="marca")
     */
    private $modelos;

    public function __construct()
    {
        $this->modelos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return Collection|Modelo[]
     */
    public function getModelos(): Collection
    {
        return $this->modelos;
    }

    public function addModelo(Modelo $modelo): self
    {
        if (!$this->modelos->contains($modelo)) {
            $this->modelos[] = $modelo;
            $modelo->setMarca($this);
        }

        return $this;
    }

    public function removeModelo(Modelo $modelo): self
    {
        if ($this->modelos->contains($modelo)) {
            $this->modelos->removeElement($modelo);
            // set the owning side to null (unless already changed)
            if ($modelo->getMarca() === $this) {
                $modelo->setMarca(null);
            }
        }

        return $this;
    }
}
