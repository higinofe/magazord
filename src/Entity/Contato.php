<?php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "contatos")]
class Contato
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private int $id;

    #[ORM\Column(type: "string", length: 50)]
    private string $tipo;

    #[ORM\Column(type: "string", length: 255)]
    private string $descricao;

    #[ORM\ManyToOne(targetEntity: Pessoa::class, inversedBy: "contatos")]
    #[ORM\JoinColumn(name: "pessoa_id", referencedColumnName: "id", nullable: false, onDelete: "CASCADE")]
    private Pessoa $pessoa;

     // Métodos getters e setters

     public function getId(): int
     {
         return $this->id;
     }
 
     public function getTipo(): string
     {
         return $this->tipo;
     }
 
     public function setTipo(string $tipo): void
     {
         $this->tipo = $tipo;
     }
 
     public function getDescricao(): string
     {
         return $this->descricao;
     }
 
     public function setDescricao(string $descricao): void
     {
         $this->descricao = $descricao;
     }
 
     public function getPessoa(): Pessoa
     {
         return $this->pessoa;
     }
 
     public function setPessoa(Pessoa $pessoa): void
     {
         $this->pessoa = $pessoa;
     }

}
