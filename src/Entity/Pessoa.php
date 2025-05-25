<?php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity]
#[ORM\Table(name: "pessoas")]
class Pessoa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 100)]
    private string $nome;

    #[ORM\Column(type: "string", length: 11, unique: true)]
    private string $cpf;

    #[ORM\Column(type: "string", length: 20)]
    private string $rg;

    #[ORM\Column(type: "string", length: 10)]
    private string $sexo;

    #[ORM\OneToMany(mappedBy: "pessoa", targetEntity: Contato::class, cascade: ["persist", "remove"])]
    private Collection $contatos;

    public function __construct()
    {
        $this->contatos = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function getRg(): ?string
    {
        return $this->rg;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    // SETTERS
    public function setNome(string $nome): self
    {
        $this->nome = $nome;
        return $this;
    }

    public function setCpf(?string $cpf): self
    {
        $this->cpf = $cpf;
        return $this;
    }

    public function setRg(?string $rg): self
    {
        $this->rg = $rg;
        return $this;
    }

    public function setSexo(?string $sexo): self
    {
        $this->sexo = $sexo;
        return $this;
    }

    // Getters e setters (sugestão: use seu IDE para gerar rapidamente)
}
