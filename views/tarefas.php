<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Tarefas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="tarefas-container">
    <h1>📋 Gerenciar Tarefas</h1>

 <div class="create-task">
    <a href="?page=criar" class="create-btn">
        <span class="plus-icon">+</span> Nova Tarefa
    </a>
</div>



    <!-- 🔍 Formulário de Filtro -->
    <form method="get" class="filter-form">
        <input type="hidden" name="page" value="tarefas">
        <label>Filtrar por prioridade:</label>
        <select name="filtro_prioridade" onchange="this.form.submit()">
            <option value="0">Todas</option>
            <option value="1">1 - Baixa</option>
            <option value="2">2 - Média</option>
            <option value="3">3 - Alta</option>
        </select>
    </form>

    <!-- 📋 Tabela de Tarefas -->
    <table class="table-tasks">
        <thead>
        <tr>
            <th>Título</th>
            <th>Descrição</th>
            <th>Prioridade</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php if (empty($tarefas)): ?>
            <tr>
                <td colspan="4">Nenhuma tarefa encontrada.</td>
            </tr>
        <?php endif; ?>
        <?php foreach ($tarefas as $tarefa): ?>
            <tr class="priority-<?= htmlspecialchars($tarefa['prioridade']) ?>">
                <td><?= htmlspecialchars($tarefa['titulo']) ?></td>
                <td><?= htmlspecialchars($tarefa['descricao']) ?></td>
                <td>
                    <?= $tarefa['prioridade'] ?> -
                    <?php
                    echo match((int)$tarefa['prioridade']) {
                        1 => 'Baixa',
                        2 => 'Média',
                        3 => 'Alta',
                        default => 'Desconhecida'
                    };
                    ?>
                </td>
                <td class="actions">
                    <a class="edit-btn" href="?page=editar&id=<?= $tarefa['id'] ?>">Editar</a>
                    <a class="delete-btn" href="?page=excluir&id=<?= $tarefa['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
