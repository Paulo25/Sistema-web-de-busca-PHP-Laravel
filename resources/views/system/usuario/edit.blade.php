<style>
.olho {
cursor: pointer;
left: 304px;
bottom: 51px;
position: absolute;
width: 30px;
}
</style>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" style="text-align: center">Editar Usuário</h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
            <form action="{{route('system.usuarioController.update', $user->id_usuario)}}" method="POST" class="edit-usuario">
                @csrf
                @method('PUT')
                <div class="form-group">
                     <label>Nome<span class="riquered">*</span></label>
                     <input type="text" name="nome" value="{{$user->nome}}" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Email<span class="riquered">*</span></label>
                    <input type="email" name="email" value="{{$user->email}}" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group">
                    <label>Senha<span class="riquered">*</span></label>
                    <img src="{{asset('olho.png')}}" id="olho" class="olho">
                    <input type="password" name="senha" value="{{ decrypt($user->senha)}}" class="form-control" id="pass"/>
                </div>

                <div class="row">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{mix('js/pageUsuario.js')}}"></script>
