<?php require __DIR__ . '/../layout/header.php'; ?>
<div class="col-md-6">
    <h1>Edição de Produto</h1>
    <form action="<?php echo BASE_URL; ?>/produtos/editar/<?= $produto->id?> " method="post">
        <div class="mb-3">
            <label class="form-label" for="nome" class="form-label">Nome:</label>
            <input class="form-control" type="text" id="nome" name="nome" value="<?= $produto->nome;?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="descricao" value:>Descrição:</label>
            <textarea class="form-control" name="descricao" id="descricao" required><?= $produto->descricao;?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label" for="precoVenda">Preço de Venda:</label>
            <input class="form-control" type="number" step=".01" id="precoVenda" name="preco_venda" value="<?= $produto->preco_venda;?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="estoque">Estoque:</label>
            <input class="form-control" type="number" id="estoque" name="estoque_atual" value="<?= $produto->estoque_atual;?>" disabled readonly>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
<?php require __DIR__ . '/../layout/footer.php'; ?>