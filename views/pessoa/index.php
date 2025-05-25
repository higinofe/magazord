<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/menu.php'; ?>

<div class="container py-5">
    <!-- Título e botão -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Lista de Pessoas</h2>
        <a href="/pessoa/create" class="btn btn-success">
            <i class="fas fa-user-plus"></i> Nova Pessoa
        </a>
    </div>

    <!-- Card com a tabela -->
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-striped table-hover" id="tabelaPessoas">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>RG</th>
                        <th>Sexo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pessoas as $p): ?>
                        <tr>
                            <td><?= $p->getId() ?></td>
                            <td><?= htmlspecialchars($p->getNome()) ?></td>
                            <td><?= htmlspecialchars($p->getCpf()) ?></td>
                            <td><?= htmlspecialchars($p->getRg()) ?></td>
                            <td><?= $p->getSexo() === 'M' ? 'Masculino' : ($p->getSexo() === 'F' ? 'Feminino' : '' ) ?></td>
                            <td>
                                <a href="/pessoa/edit?id=<?= $p->getId() ?>" class="btn btn-sm btn-primary me-1">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <a href="/pessoa/delete?id=<?= $p->getId() ?>" class="btn btn-sm btn-danger"
                                   onclick="return confirm('Confirmar exclusão?')">
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
        $('#tabelaPessoas').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
            },
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100]
        });
    });
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
