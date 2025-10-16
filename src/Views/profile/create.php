<?php require __DIR__ . '/../layout/header.php'; ?>
<h1>Novo Perfil</h1>
<form action="/profiles/store" method="POST">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" required>
    <button type="submit">Salvar</button>
</form>
<?php require __DIR__ . '/../layout/footer.php'; ?>
