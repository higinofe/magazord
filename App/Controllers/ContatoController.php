<?php

namespace App\Controllers;

use Doctrine\ORM\EntityManager;
use Entity\Contato;
use Entity\Pessoa;

class ContatoController
{
    private $em;

    public function __construct()
    {
        $this->em = require realpath(__DIR__ . '/../../config/doctrine.php');
    }

    public function index() {
        $repo = $this->em->getRepository(Contato::class);
        $contatos = $repo->findAll();
        include __DIR__ . '/../../views/contato/index.php';
    }

    public function create() {
        $pessoas = $this->em->getRepository(Pessoa::class)->findAll();
        include __DIR__ . '/../../views/contato/form.php';
    }

    public function store() {
        $contato = new Contato();
        $contato->setTipo($_POST['tipo']);
        $contato->setDescricao($_POST['valor']);
        $pessoa = $this->em->find(Pessoa::class, $_POST['pessoa_id']);
        $contato->setPessoa($pessoa);
        $this->em->persist($contato);
        $this->em->flush();
        header('Location: /contatos');
    }

    public function edit() {
        $contato = $this->em->find(Contato::class, $_GET['id']);
        $pessoas = $this->em->getRepository(Pessoa::class)->findAll();
        include __DIR__ . '/../../views/contato/form.php';
    }

    public function update() {
        $contato = $this->em->find(Contato::class, $_POST['id']);
        $contato->setTipo($_POST['tipo']);
        $contato->setValor($_POST['valor']);
        $pessoa = $this->em->find(Pessoa::class, $_POST['pessoa_id']);
        $contato->setPessoa($pessoa);
        $this->em->flush();
        header('Location: /contatos');
    }

    public function delete() {
        $contato = $this->em->find(Contato::class, $_GET['id']);
        $this->em->remove($contato);
        $this->em->flush();
        header('Location: /contatos');
    }
}