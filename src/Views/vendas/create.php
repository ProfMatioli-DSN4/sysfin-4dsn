<?php require __DIR__ . '/../layout/header.php'; ?>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/estilo.css">

<h2>Registrar Nova Venda</h2>
<form  id="vendaForm" method="POST" action="/vendas/finalizar">
    <label for="cliente">Cliente:</label>
    <select name="id_cliente" id="cliente" required>
        <option value="">Selecione...</option>
        <?php foreach ($clientes as $cliente): ?>
            <option value="<?= $cliente->id ?>">
            <?= htmlspecialchars($cliente->nome) ?>
            </option>
        <?php endforeach; ?>
    </select>

     <hr>

  <h3>Itens da Venda</h3>
  <div> 
    <select id="produto">
      <option value="">Selecione um produto...</option>
      <?php foreach ($produtos as $produto): ?>
        <option 
          value="<?= $produto->id ?>" 
          data-preco="<?= $produto->preco_venda ?>" 
          data-estoque="<?= $produto->estoque_atual ?>">
          <?= htmlspecialchars($produto->nome) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <input type="number" id="quantidade" placeholder="Qtd" min="1">
    <input type="number" id="preco" placeholder="Preço Unit." step="0.01">
    <button type="button" id="addItem">Adicionar</button>
  </div>

  <table border="1" id="tabelaItens">
    <thead>
      <tr>
        <th>Produto</th>
        <th>Qtd</th>
        <th>Preço Unit.</th>
        <th>Subtotal</th>
        <th>Ação</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>

  
  <h3>Total: R$ <span id="valorTotal">0.00</span></h3>

  <button type="submit">Finalizar Venda</button>
</form>
<script>
  const tabela = document.querySelector("#tabelaItens tbody");
  const totalSpan = document.querySelector("#valorTotal");
  let itens = [];

  document.querySelector("#produto").addEventListener("change", e => {
    const opt = e.target.selectedOptions[0];
    document.querySelector("#preco").value = opt.dataset.preco || "";
  });

  document.querySelector("#addItem").addEventListener("click", () => {
    const produtoSelect = document.querySelector("#produto");
    const id = produtoSelect.value;
    const nome = produtoSelect.selectedOptions[0]?.textContent;
    const estoque = produtoSelect.selectedOptions[0]?.dataset.estoque;
    const qtd = parseInt(document.querySelector("#quantidade").value);
    const preco = parseFloat(document.querySelector("#preco").value);

    if (!id || !qtd || qtd <= 0 || qtd > estoque) {
      alert("Quantidade inválida!");
      return;
    }

    const subtotal = (qtd * preco).toFixed(2);
    itens.push({ id, nome, qtd, preco, subtotal });

    const row = document.createElement("tr");
    row.innerHTML = `
      <td>${nome}</td>
      <td>${qtd}</td>
      <td>R$ ${preco.toFixed(2)}</td>
      <td>R$ ${subtotal}</td>
      <td><button type="button" class="remove">X</button></td>
    `;
    tabela.appendChild(row);
    atualizarTotal();

    row.querySelector(".remove").onclick = () => {
      itens = itens.filter(i => i.id !== id);
      row.remove();
      atualizarTotal();
    };
  });

  function atualizarTotal() {
    const total = itens.reduce((acc, i) => acc + parseFloat(i.subtotal), 0);
    totalSpan.textContent = total.toFixed(2);
  }

  // Enviar dados como JSON
  document.querySelector("#vendaForm").addEventListener("submit", e => {
    const hidden = document.createElement("input");
    hidden.type = "hidden";
    hidden.name = "itens";
    hidden.value = JSON.stringify(itens);
    e.target.appendChild(hidden);
  });
</script>
<?php require __DIR__ . '/../layout/footer.php'; ?>