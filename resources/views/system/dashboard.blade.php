@extends('templates.modelo_system')

@section('conteudo')
    <div style="text-align: center; color: #00a7d0;"><h3 style="font-weight: bold">DASHBOARD</h3></div>
    <div class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 text-center">
                <h5>Linguagens criadas no ano atual</h5>
                <div id="createdLanguagesContainer"
                     style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        const graficDataCreatedLanguage = JSON.parse('<?php echo $graficDataCreatedLanguage ?>');
    </script>
    <script src="{{ mix('js/pageDashboard.js')}}"></script>
@endsection

