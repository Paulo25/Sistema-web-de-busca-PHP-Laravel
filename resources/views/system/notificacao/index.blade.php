@extends('../../templates.modelo_system')

@section('conteudo')
    <div style="text-align: center; color: #00a7d0;"><h3 style="font-weight: bold">GERENCIAMENTO DE NOTIFICAÇÃO</h3></div>
    <div class="content">
        <div class="row">
            <form>
                @csrf
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    {{--<label for="mensagem">MENSAGEM <span class="riquered">*</span></label>--}}
                    <textarea name="mensagem" cols="5" rows="5" id="mensagem" placeholder="Digite sua mensagem aqui..."
                              class="form-control"></textarea>
                </div>
            </div>
            </form>
        </div>
        <div class="row">
            <div class="text-center">
                <button type="button" class="btn btn-primary btn-notify">ENVIAR NOTIFICAÇÃO</button>
            </div>
        </div>
    </div>
@endsection

<script src="{{mix('js/pageNotificacao.js')}}"></script>

