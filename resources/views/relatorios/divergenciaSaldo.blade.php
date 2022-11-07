<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>Divergência de Saldos | PaddockBet</h2>

<table>
  <tr>
    <th>#ID</th>
    <th>Nome</th>
    <th>Saldo</th>
    <th>Saldo2</th>
    <th>Divergência</th>
  </tr>
  @foreach($users as $user)
  <tr>
    <td>{{$user->id}}</td>
    <td>{{$user->nome}}</td>
    <td>R$ {{$user->saldo}}</td>
    <td>R$ {{$user->saldo2}}</td>
    <td>R$ {{$user->saldo - $user->saldo2}}</td>
  </tr>
  @endforeach
</table>

</body>
</html>

