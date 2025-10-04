<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>SysFin - 4DSN | Entre em nosso Sistema</title>

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/estilo.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <?php require __DIR__ . '/../layout/header_login.php'; ?>

    <main class="d-flex align-items-center justify-content-center flex-grow-1">
        <div class="card col-md-5 shadow-sm">
            <div class="card-body">
                <h2 class="card-title text-center">Acesse sua Conta</h2>
                <form class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">E-mail:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="invalid-feedback">
                            Por favor, informe o seu e-mail.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label fw-bold">Senha:</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                        <div class="invalid-feedback">
                            Por favor, insira uma senha válida.
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Acessar</button>
                    </div>
                </form>
            </div>

        </div>
    </main>

    <?php require __DIR__ . '/../layout/footer.php'; ?>

    <script>
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    </script>