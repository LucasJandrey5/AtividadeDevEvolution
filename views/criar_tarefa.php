<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Tarefas</title>
    <link rel="stylesheet" href="style.css">

    <style>
        .tarefas-container {
            max-width: 900px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2em;
        }

        form {
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"], textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 16px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .filter-form {
            margin-top: -20px;
            margin-bottom: 30px;
        }

        .table-tasks {
            width: 100%;
            border-collapse: collapse;
        }

        .table-tasks th, .table-tasks td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .table-tasks th {
            background-color: #f0f0f0;
        }

        .priority-1 {
            background-color: #d4edda;
            color: #155724;
        }

        .priority-2 {
            background-color: #fff3cd;
            color: #856404;
        }

        .priority-3 {
            background-color: #f8d7da;
            color: #721c24;
        }

        .actions a {
            text-decoration: none;
            padding: 6px 12px;
            margin-right: 5px;
            color: white;
            border-radius: 4px;
        }

        .edit-btn {
            background-color: #28a745;
        }

        .delete-btn {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
<div class="tarefas-container">
    <h1>📋 <?php echo isset($tarefa) ? "Editar " : "Criar Nova " ?>Tarefa  <?php echo $tarefa['id'] ?></h1>

    <div class="create-task">
        <a href="?page=tarefas" class="create-btn">
            <span class="plus-icon">⬅</span> Voltar
        </a>
    </div>

    <!-- ➕ Formulário de Adicionar / Atualizar -->
    <form method="post" action="?page=salvarTarefa">
        <input type="hidden" name="id" value="<?php echo isset($tarefa) ? htmlspecialchars($tarefa['id']) : ''; ?>">

        <label for="titulo">Título:</label>
        <input type="text" name="titulo" id="titulo" placeholder="Digite o titulo aqui..." required value="<?php echo isset($tarefa) ? htmlspecialchars($tarefa['titulo']) : ''; ?>">

        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao" placeholder="Digite a descrição..."><?php echo isset($tarefa) ? htmlspecialchars($tarefa['descricao']) : '';  ?></textarea>

        <label for="prioridade">Prioridade:</label>
        <select name="prioridade" id="prioridade" required>
            <option value="1" <?= (isset($tarefa) && $tarefa['prioridade'] == 1) ? 'selected' : '' ?>>1 - Baixa</option>
            <option value="2" <?= (isset($tarefa) && $tarefa['prioridade'] == 2) ? 'selected' : '' ?>>2 - Média</option>
            <option value="3" <?= (isset($tarefa) && $tarefa['prioridade'] == 3) ? 'selected' : '' ?>>3 - Alta</option>
        </select>

        <button type="submit">
            <?php echo isset($tarefa) ? "Salvar" : "Criar" ?> Tarefa
        </button>
    </form>
</div>
</body>
</html>
