<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" style="text-align: center">Editar Linguagem de Programação</h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form action="{{route('system.adminController.update', [$question->id] )}}" method="post" action="javascript:;"
                  enctype="multipart/form-data" class="submit-edit">
                @csrf
                @method('POST')
                {{--<input type="hidden" value="PUT" name="_method">--}}
                <div class="form-group">
                    <label for="nome">Nome <span class="riquered">*</span></label>
                    <input type="text" value="{{$question->nome}}" name="nome" class="form-control" autocomplete="off"/>
                    @if($errors->has('nome'))<span class="text-danger">{{$errors->first('nome')}}</span>@endif
                </div>
                @if($errors->has('nome'))
                    <span class="text-danger">
                    <strong>{{$errors->first('nome')}}</strong>
                </span>
                @endif
                <div class="form-group">
                    <label for="conteudo">Conteúdo <span class="riquered">*</span></label>
                    <textarea name="conteudo" cols="30" rows="10"
                              class="form-control">{{$question->conteudo}}</textarea>
                    @if($errors->has('conteudo'))<span class="text-danger">{{$errors->first('conteudo')}}</span>@endif
                </div>
                @if($errors->has('conteudo'))
                    <span class="text-danger">
                        <strong>{{$errors->first('conteudo')}}</strong>
                    </span>
                @endif
                <div class="col-xs-6 col-sm-6 col-md-4">
                    <div class="form-group">
                        <label for="status">Status <span class="riquered">*</span></label>
                        <select name="status" class="form-control">
                            <option value='1' @if($question->status == '1'): selected @endif >Ativo</option>
                            <option value='0' @if($question->status == '0'): selected @endif >Inativo</option>
                        </select>
                        @if($errors->has('status'))<span class="text-danger">{{$errors->first('status')}}</span>@endif
                    </div>
                </div>
                @if($errors->has('status'))
                    <span class="text-danger">
                        <strong>{{$errors->first('status')}}</strong>
                    </span>
                @endif
                <div class="form-group">
                    <label for="checkbox">Topo:</label>
                    <input type="hidden" name="checkbox" value="0">
                    <input type="checkbox" name="checkbox" value="1"
                           @if($question->topo == '1'): checked @endif
                           title="Ao selecionar este campo esta linguagem irá pro topo da lista.">


                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="arquivo" name="arquivo">
                        <label class="custom-file-label" for="arquivo">Escolha um arquivo</label>
                        @php
                            $fileName = storage_path('app' .DIRECTORY_SEPARATOR. 'public'.DIRECTORY_SEPARATOR. $question->path_imagem );
                            $fileName = str_replace('\\','/',$fileName);
                        @endphp
                        @if($question->path_imagem)
                            <img src="{{route('storage') . "?path=" . str_replace('\\','/',$question->path_imagem)}}" width="100px" height="50px">
                        @endif
                    </div>
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


<script src="{{mix('js/pageEdit.js')}}"></script>

