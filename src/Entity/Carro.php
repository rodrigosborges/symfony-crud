<?php

namespace App\Entity;

use App\Repository\CarroRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarroRepository::class)
 */
class Carro
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
    private $proprietario;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $placa;

    /**
     * @ORM\ManyToOne(targetEntity=Modelo::class, inversedBy="carros")
     * @ORM\JoinColumn(nullable=false)
     */
    private $modelo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProprietario(): ?string
    {
        return $this->proprietario;
    }

    public function setProprietario(string $proprietario): self
    {
        $this->proprietario = $proprietario;

        return $this;
    }

    public function getPlaca(): ?string
    {
        return $this->placa;
    }

    public function setPlaca(string $placa): self
    {
        $this->placa = strtoupper($placa);

        return $this;
    }

    public function getModelo(): ?Modelo
    {
        return $this->modelo;
    }

    public function setModelo(?Modelo $modelo): self
    {
        $this->modelo = $modelo;

        return $this;
    }
}
