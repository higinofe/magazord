<?php require __DIR__ . '/../layout/header.php'; ?>
<?php require __DIR__ . '/../layout/menu.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><?= isset($pessoa) ? 'Editar' : 'Cadastrar' ?> Pessoa</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= isset($pessoa) ? '/pessoa/update' : '/pessoa/store' ?>">
                        <?php if (isset($pessoa)): ?>
                            <input type="hidden" name="id" value="<?= $pessoa->getId() ?>">
                        <?php endif; ?>

                        <div class="form-floating mb-3">
                            <input type="text" name="nome" class="form-control" id="nome"
                                   placeholder="Nome" value="<?= isset($pessoa) ? $pessoa->getNome() : '' ?>" required>
                            <label for="nome">Nome</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" name="cpf" class="form-control" id="cpf"
                                   placeholder="CPF" value="<?= isset($pessoa) ? $pessoa->getCpf() : '' ?>">
                            <label for="cpf">CPF</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" name="rg" class="form-control" id="rg"
                                   placeholder="RG" value="<?= isset($pessoa) ? $pessoa->getRg() : '' ?>">
                            <label for="rg">RG</label>
                        </div>

                        <div class="form-floating mb-4">
                            <select class="form-select" name="sexo" id="sexo">
                                <option value="">Selecione o sexo</option>
                                <option value="M" <?= isset($pessoa) && $pessoa->getSexo() === 'M' ? 'selected' : '' ?>>Masculino</option>
                                <option value="F" <?= isset($pessoa) && $pessoa->getSexo() === 'F' ? 'selected' : '' ?>>Feminino</option>
                            </select>
                            <label for="sexo">Sexo</label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/pessoas" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Voltar
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Salvar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
