<!DOCTYPE html>
<html>
<head>
    <title>Tarefas</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
<h1>Tarefas</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Descrição</th>
        <th>Estado</th>
        <th>Previsao</th>
        <th>Entrega</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($data as $task)
        <tr>
            <td>{{ $task['id'] }}</td>
            <td>{{ $task['Titulo'] }}</td>
            <td>{{ $task['Descrição'] }}</td>
            <td>{{ $task['Estado'] }}</td>
            <td>{{ $task['Previsao'] }}</td>
            <td>{{ $task['Entrega'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
