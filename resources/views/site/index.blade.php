@extends('../templates/modelo_site')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div>
                <strong> <span style="color:red;"><h3>Dicionário de liguagem de programação</h3> </span></strong>
            </div>
            <br>

            <div class="rows">
                <form action="{{route('site.buscaController.buscar')}}" method="GET" class="form-busca">
                    @csrf
                    <input type="text" name="nome" value="{{old('nome')}}" required placeholder="ex: php">
                    <button type="submit" id="btnLinguagem"> Buscar</button>
                </form>
                @if ($errors->has('nome'))
                    <span class="text-danger">{{ $errors->first('nome') }}</span>
                @endif
            </div>
            <br>
            <div>
                @if(!empty($infos))
                    <table class="table">
                        <tbody>
                        @if($infos->path_imagem)
                            <img src="{{route('storage') . "?path=" . str_replace('\\','/', $infos->path_imagem)}}"
                                 width="150px" height="100px"><br/><br/>
                        @endif
                        <tr>
                            <th>{{$infos->nome}}</th>
                        </tr>
                        <tr>
                            <td>{{$infos->conteudo}}
                            <td>
                        </tr>
                        </tbody>
                    </table>
                @elseif(!empty($infoAssociado))
                    <span>Você quis dizer
                        <a href="{{Route('site.buscaController.buscarPalavraAssociada', $infoAssociado->nome)}}"
                           id="palavra">{{$infoAssociado->nome}}?</a>
                        </span>
                @else
                    <span style="font-size: 11px; color:red;"> Nenhum registro com este nome foi encontrado... </span>
                @endif


            </div>
        </div>
    </div>

@endsection

