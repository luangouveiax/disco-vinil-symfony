<?php

namespace App\Entity;

use App\Repository\DiscoVinilRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiscoVinilRepository::class)]
class DiscoVinil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descricao = null;

    #[ORM\Column]
    private ?int $contaFaixas = null;

    #[ORM\Column(length: 255)]
    private ?string $genero = null;

    #[ORM\Column]
    private \DateTimeImmutable $criado;

    #[ORM\Column]
    private int $votos = 0;

    public function __construct() {
        $this->criado = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getContaFaixas(): ?int
    {
        return $this->contaFaixas;
    }

    public function setContaFaixas(int $contaFaixas): self
    {
        $this->contaFaixas = $contaFaixas;

        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    public function getCriado(): ?\DateTimeImmutable
    {
        return $this->criado;
    }

    public function setCriado(\DateTimeImmutable $criado): self
    {
        $this->criado = $criado;

        return $this;
    }

    public function getVotos(): ?int
    {
        return $this->votos;
    }

    public function setVotos(int $votos): self
    {
        $this->votos = $votos;

        return $this;
    }

    public function upVoto(): void
    {
        $this->votos++;
    }

    public function downVoto(): void
    {
        $this->votos--;
    }

    public function getVotosString(): string
    {
        $prefix = ($this->votos === 0) ? '' : (($this->votos >= 0) ? '+' : '-');

        return sprintf('%s %d', $prefix, abs($this->votos));
    }

    public function getImageUrl(int $width): string
    {
        return sprintf(
            'https://picsum.photos/id/%d/%d',
            ($this->getId() + 50) % 1000, // number between 0 and 1000, based on the id
            $width
        );
    }
}
