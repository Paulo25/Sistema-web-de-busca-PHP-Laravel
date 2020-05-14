<table>
    <thead>
    <tr>
        <th>LINGUAGEM</th>
        <th>CONTEUDO</th>
        <th>STATUS</th>
    </tr>
    </thead>
    <tbody>
    @foreach($linguagens as $linguagem)
        <tr>
            <td>{{ $linguagem->nome }}</td>
            <td>{{ $linguagem->conteudo }}</td>
            <td>{{ $linguagem->status == \App\Enums\LinguagemStatus::ATIVO ? 'ATIVO' : 'INATIVO'}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
