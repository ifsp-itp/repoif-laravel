<h1>Dados do usuário</h1>

<table border="1">
<tr>
	<td><strong>This is Name:</strong></td>
	<td>{{ $user->name }}</td>
</tr>
<tr>
	<td><strong>This is e-mail:</strong></td>
	<td>{{ $user->email }}</td>
</tr>
</table>

<h1>Projetos:</h1>

<table border="1">
	<tr>
		<td><a href="#">id</a></td>
		<td>nome</td>
		<td>data</td>
		<td>tipo</td>
	</tr>
	
</table>


<br>
<a href="/projects">Voltar</a>