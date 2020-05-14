@extends('templates.modelo_system')

@section('conteudo')

    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <h3>Lista de Linguagens de Programação <a href="{{route('system.adminController.create')}}">
                    <button class="btn btn-success">Novo</button>
                </a></h3>
            @include('system.search')
        </div>
    </div>

    <div class="panel-heading">
        <div class="pull-right">
            @if(count($questions))
                <form action="{{route('system.adminController.export')}}" method="get" class="export-ajax">
                    @csrf
                    <button class="btn btn-danger">Exportar <i class="fas fa-file-export"></i></button>
                </form>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>IMAGEM</th>
                        <th>NOME</th>
                        <th>CONTEÚDO</th>
                        <th>STATUS</th>
                        <th>DATA DE ATUALIZAÇÃO</th>
                        <th>AÇÕES</th>
                    </tr>
                    </thead>
                    @if(count($questions))
                        @foreach ($questions as $question)
                            <tbody>
                            <tr>
                                <td>{{ $question->id}}</td>
                                <td>
                                    @php
                                        $fileName = storage_path('app' .DIRECTORY_SEPARATOR. 'public'.DIRECTORY_SEPARATOR. $question->path_imagem );
                                        $fileName = str_replace('\\','/',$fileName);
                                    @endphp
                                    @if($question->path_imagem)
                                        <img
                                            src="{{route('storage') . "?path=" . str_replace('\\','/', $question->path_imagem)}}"
                                            width="100px" height="50px">
                                    @else
                                        <img src="{{asset('sem-imagem.jpg')}}" width="100px" height="50px">
                                    @endif
                                </td>
                                <td>{{ $question->nome}}</td>
                                <td>{{mb_strimwidth($question->conteudo, 0, 360, "...")}}</td>
                                <td>@if($question->status == 1) Ativo @else Inativo @endif</td>
                                <td>{{date('d/m/Y', strtotime($question->dt_atualizacao))}}</td>
                                <td>
                                    <a href="{{route('system.adminController.edit', $question->id )}}"
                                       class="action-btn"> <i
                                            class="fas fa-edit fa-lg" title="Editar"></i></a>

                                    <a href="{{route('system.adminController.delete', $question->id)}}"
                                       class="action-btn"> <i class="fas fa-trash  fa-lg" title="Excluir"></i></a>

                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    @else
                        <td colspan="7">
                            <span>Nenhum registro encontrado...</span>
                        </td>
                    @endif
                </table>
            </div>
        </div>
        <nav class="menu">
            <ul>
                {{$questions->render()}}
            </ul>
        </nav>
    </div>


    <!-- ==================MODAL DEFAULT ==================-->
    <div class="modal fade" id="modalDefault" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         data-keyboard="false"
         data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <!-- Content -->
            </div>
        </div>
    </div>
    <!-- ==================FIM MODAL DEFAULT ==================-->


@endsection
