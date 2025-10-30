<?php require __DIR__ . '/../layout/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-danger text-center" role="alert">
                <h4 class="alert-heading">
                    <i class="bi bi-exclamation-triangle-fill"></i> Acesso Negado
                </h4>
                <hr>
                <p class="mb-0"><?= $erroAcesso ?? 'Você não tem permissão para acessar esta página.' ?></p>
                <hr>
                <p class="mb-0">
                    <small>Apenas usuários com perfil de <strong>Administrador</strong> ou <strong>Tesoureiro</strong> podem visualizar o relatório de vendas.</small>
                </p>
                <div class="mt-4">
                    <a href="<?php echo BASE_URL; ?>/" class="btn btn-primary">Voltar para a Página Inicial</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../layout/footer.php'; ?>
