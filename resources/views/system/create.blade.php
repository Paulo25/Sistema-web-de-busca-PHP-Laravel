@extends('templates.modelo_system')

@section('conteudo')
    <div style="text-align: center; color: #00a7d0;"><h3 style="font-weight: bold">NOVA LINGUAGEM DE PROGRAMAÇÃO</h3>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                @if (session('sucess'))
                    <div class="alert alert-success">
                        {{ session('sucess') }}
                    </div>
                @endif
                <form action="{{route('system.adminController.store')}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nome">Nome <span class="riquered">*</span></label>
                        <input type="text" name="nome" value="{{old('nome')}}" class="form-control"
                               placeholder="Nome...">
                        @if ($errors->has('nome'))
                            <span class="text-danger">{{ $errors->first('nome') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Conteúdo <span class="riquered">*</span></label>
                        <textarea name="conteudo" cols="30" rows="10"
                                  class="form-control">{{old('conteudo')}}</textarea>
                        @if ($errors->has('conteudo'))
                            <span class="text-danger">{{ $errors->first('conteudo') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="checkbox">Topo:</label>
                        <input type="hidden" name="checkbox" value="0">
                        <input type="checkbox" name="checkbox" value="1"
                               title="Ao selecionar este campo esta linguagem irá pro topo da lista.">
                    </div>
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="arquivo" name="arquivo">
                            <label class="custom-file-label" for="arquivo">Escolha um arquivo</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Salvar</button>
                        <button class="btn btn-danger" type="reset">Limpar</button>
                    </div>
                </form>

                <input type="text" class="datep" />
            </div>
        </div>
    </div>


@endsection

