<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/menu.php'; ?>

<div class="container py-5">

    <!-- Botão novo contato -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Lista de Contatos</h2>
        <a href="/contatos/create" class="btn btn-success">
            <i class="fas fa-plus"></i> Novo Contato
        </a>
    </div>

    <!-- Formulário (inserir ou editar) -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><?= isset($_GET['id']) ? 'Editar Contato' : 'Novo Contato' ?></h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= isset($_GET['id']) ? '/contatos/update' : '/contatos/store' ?>" id="formContato">
                        <?php if (isset($contato)): ?>
                            <input type="hidden" name="id" value="<?= $contato->getId() ?>">
                        <?php endif; ?>

                        <div class="mb-3">
                            <label class="form-label">Tipo</label>
                            <input type="text" name="tipo" class="form-control" value="<?= isset($contato) ? $contato->getTipo() : '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Valor</label>
                            <input type="text" name="valor" class="form-control" value="<?= isset($contato) ? $contato->getDescricao() : '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pessoa</label>
                            <select name="pessoa_id" class="form-select" required>
                                <option value="">Selecione</option>
                                <?php foreach ($pessoas as $p): ?>
                                    <option value="<?= $p->getId() ?>" <?= isset($contato) && $contato->getPessoa()->getId() == $p->getId() ? 'selected' : '' ?>>
                                        <?= $p->getNome() ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Salvar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function () {
        $('#tabelaContatos').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
            },
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50],
        });

        $('#formContato').hide().fadeIn(400);
    });
</script>

<?php require __DIR__ . '/../layout/footer.php'; ?>
