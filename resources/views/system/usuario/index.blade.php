@extends('../../templates.modelo_system')

@section('conteudo')
    <div style="text-align: center; color: #00a7d0;"><h3 style="font-weight: bold">USUÁRIOS</h3></div>
    <div class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>EMAIL</th>
                            <th>STATUS</th>
                            <th>DATA DE ATUALIZAÇÃO</th>
                            <th>AÇÕES</th>
                        </tr>
                        </thead>
                        @foreach($users as $key => $user)
                            <tbody>
                            <tr>
                                <td>{{$user->id_usuario}}</td>
                                <td>{{$user->nome}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->status == \App\Enums\UsuarioStatus::ATIVO ? 'Ativo' : 'Inativo'}}</td>
                                <td>{{date('d/m/Y H:i:s', strtotime($user->dt_atualizacao))}}</td>
                                <td>
                                    <a href="{{route('system.usuarioController.edit', $user->id_usuario)}}"
                                       title="EDITAR" class="action-btn"><i class="fas fa-edit fa-lg"></i></a>
                                    @if($user->status == \App\Enums\UsuarioStatus::ATIVO )
                                        <a class="btn-activation"
                                           data-href="{{route('system.usuarioController.alterStatusUser' , $user->id_usuario)}}"
                                           data-id="{{$user->id_usuario}}"
                                           data-user-status="{{\App\Enums\UsuarioStatus::INATIVO}}">
                                            <span class="fas fa-toggle-on fa-lg" title="DESATIVAR"></span>
                                        </a>
                                    @else
                                        <a class="btn-activation"
                                           data-href="{{route('system.usuarioController.alterStatusUser' , $user->id_usuario)}}"
                                           data-id="{{$user->id_usuario}}"
                                           data-user-status="{{\App\Enums\UsuarioStatus::ATIVO}}">
                                            <span class="fas fa-toggle-off fa-lg" title="ATIVAR"></span>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
            <nav class="menu">
                <ul>

                </ul>
            </nav>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
<script src="{{mix('js/pageUsuario.js')}}"></script>
@endsection
