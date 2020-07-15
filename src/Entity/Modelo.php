<?php

namespace App\Entity;

use App\Repository\ModeloRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity(repositoryClass=ModeloRepository::class)
 */
class Modelo implements JsonSerializable
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
     * @ORM\ManyToOne(targetEntity=Marca::class, inversedBy="modelos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $marca;

    /**
     * @ORM\OneToMany(targetEntity=Carro::class, mappedBy="modelo")
     */
    private $carros;

    public function __construct()
    {
        $this->carros = new ArrayCollection();
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

    public function getMarca(): ?Marca
    {
        return $this->marca;
    }

    public function setMarca(?Marca $marca): self
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * @return Collection|Carro[]
     */
    public function getCarros(): Collection
    {
        return $this->carros;
    }

    public function addCarro(Carro $carro): self
    {
        if (!$this->carros->contains($carro)) {
            $this->carros[] = $carro;
            $carro->setModelo($this);
        }

        return $this;
    }

    public function removeCarro(Carro $carro): self
    {
        if ($this->carros->contains($carro)) {
            $this->carros->removeElement($carro);
            // set the owning side to null (unless already changed)
            if ($carro->getModelo() === $this) {
                $carro->setModelo(null);
            }
        }

        return $this;
    }

    public function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'nome'=> $this->nome,
        );
    }
}
