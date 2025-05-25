<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/menu.php'; ?>

<div class="container py-5">
    <!-- Título e botão -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Lista de Contatos</h2>
        <a href="/contatos/create" class="btn btn-success">
            <i class="fas fa-plus"></i> Novo Contato
        </a>
    </div>

    <!-- Card com a tabela -->
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-striped table-hover" id="tabelaContatos">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Valor</th>
                        <th>Pessoa</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contatos as $contato): ?>
                        <tr>
                            <td><?= $contato->getId() ?></td>
                            <td><?= $contato->getTipo() ?></td>
                            <td><?= $contato->getDescricao() ?></td>
                            <td><?= $contato->getPessoa()->getNome() ?></td>
                            <td>
                                <a href="/contatos/edit?id=<?= $contato->getId() ?>" class="btn btn-sm btn-primary me-1">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <a href="/contatos/delete?id=<?= $contato->getId() ?>" class="btn btn-sm btn-danger"
                                   onclick="return confirm('Tem certeza que deseja excluir?')">
                                    <i class="fas fa-trash-alt"></i> Excluir
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- DataTables -->
<script>
    $(document).ready(function () {
        $('#tabelaContatos').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
            },
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50]
        });
    });
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
