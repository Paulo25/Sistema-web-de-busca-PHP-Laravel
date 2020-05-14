<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" style="text-align: center">Remover Imagem</h4>
</div>
<div class="modal-body">
    <form action="{{route('system.adminController.imagemDestroy', $imagem->id_imagem)}}"
          method="POST" class="submit-ajax">
        {{csrf_field()}}
        <input type="hidden" value="DELETE" name="_method">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <span style="text-align: center;">Deseja realmente apagar esta Imagem?</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="text-center">
                <button type="submit" class="btn-primary">Apagar<i class="fas fa-trash"></i></button>
            </div>
        </div>
    </form>
</div>
<div class="modal-footer">
</div>

