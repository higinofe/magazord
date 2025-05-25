<?php

namespace App\Controllers;

use Entity\Pessoa;
use Doctrine\ORM\EntityManager;

class PessoaController
{
    private $em;

    public function __construct()
    {
        $this->em = require realpath(__DIR__ . '/../../config/doctrine.php');
    }

    // Listar todas as pessoas
    public function index()
    {
        $pessoas = $this->em->getRepository(Pessoa::class)->findAll();
        require __DIR__ . '/../../views/pessoa/index.php';
    }

    // Mostrar formulário de criação
    public function create()
    {
        $pessoa = null; 
        require __DIR__ . '/../../views/pessoa/form.php';
    }

    // Persistir nova pessoa
    public function store()
    {
        $pessoa = new Pessoa();
        $pessoa->setNome($_POST['nome']);
        $pessoa->setCpf($_POST['cpf']);
        $pessoa->setRg($_POST['rg']);
        $pessoa->setSexo($_POST['sexo']);
        $this->em->persist($pessoa);
        $this->em->flush();

        header('Location: /pessoas');
    }

    // Mostrar formulário de edição
    public function edit()
    {
        $pessoa = $this->em->find(Pessoa::class, $_GET['id']);
        require __DIR__ . '/../../views/pessoa/form.php';
    }

    // Atualizar pessoa
    public function update()
    {
        $pessoa = $this->em->find(Pessoa::class, $_POST['id']);
    
        $nome = $_POST['nome'] ?? '';
        $cpf = $_POST['cpf'] ?? null;
        $rg = $_POST['rg'] ?? null;
        $sexo = $_POST['sexo'] ?? null;
    
        // Limpa CPF para só números e limita tamanho
        if ($cpf) {
            $cpf = preg_replace('/\D/', '', $cpf);
            $cpf = substr($cpf, 0, 11);
        }
    
        // Limita RG e sexo conforme tamanho da coluna, só para garantir
        if ($rg) {
            $rg = substr($rg, 0, 20);
        }
        if ($sexo) {
            $sexo = substr($sexo, 0, 10);
        }
    
        $pessoa->setNome($nome);
        $pessoa->setCpf($cpf);
        $pessoa->setRg($rg);
        $pessoa->setSexo($sexo);
    
        $this->em->flush();
    
        header('Location: /pessoas');
    }

    // Remover pessoa
    public function delete()
    {
        $pessoa = $this->em->find(Pessoa::class, $_GET['id']);
        $this->em->remove($pessoa);
        $this->em->flush();

        header('Location: /pessoas');
    }
}