@extends('templates.modelo_system')
<!-- Demo styles -->
<style>
    html, body {
        position: relative;
        height: 100%;
    }

    body {
        background: #eee;
        font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
        font-size: 14px;
        color: #000;
        margin: 0;
        padding: 0;
    }

    .swiper-container {
        width: 100%;
        height: 100%;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        /* Center slide text vertically */
        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }
</style>
@section('conteudo')
    <h2 style="text-align: center; color: #00a7d0; font-weight: bold;">Exposição de imagens</h2>
    <!-- Swiper -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach($imagens as $imagem)
                <div class="swiper-slide">
                    <div style="text-align: center;">
                        <img class="card-img-top figure-img img-fluid rounded"
                             src="{{route('storage'). "?path=" . str_replace('\\','/',$imagem->path_imagem)}}"
                             width="400px"
                             height="300px">
                        <p><br>
                        <a href="{{route('system.adminController.imagemDelete', $imagem->id_imagem)}}"
                           class="action-btn">
                            <button type="#" class="btn-danger">Apagar</button>
                        </a>
                        <form method="GET"
                              action="{{route('system.adminController.imagemDownload', $imagem->id_imagem)}}">
                            @csrf
                            <button type="submit" class="btn-danger">Download</button>
                        </form>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Add Arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>


    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper('.swiper-container', {
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
@endsection


