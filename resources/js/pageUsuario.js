$(document).ready(function (e) {


    /**
     *
     * Função revelar password
     * @type {*|jQuery.fn.init|jQuery|HTMLElement}
     */
    var senha = $('#pass');
    var olho = $('#olho');

    olho.mousedown(function () {
        senha.attr("type", "text");
    });
    olho.mouseup(function () {
        senha.attr("type", "password");
    });


    $(document).on('submit', 'form.edit-usuario', function (e) {
        e.stopPropagation();
        e.preventDefault();

        $('#ajaxLoader').css('display', 'flex');

        let url = $(this).attr('action');
        let method = 'PUT';
        let data = $(this).serialize();

        $.ajax({
            url : url,
            method : method,
            data : data
        }).done(function (res) {
            $('#ajaxLoader').css('display', 'none');
            if(res.dataAlert){
                swal(res.dataAlert).then((ok)=>{
                   if(res.refresh){
                       window.location.reload();
                   }
                });
            }
        }).fail(function (res) {
            $('#ajaxLoader').css('display', 'none');
            if(res.httpCode == 500) {
                if (res.dataAlert) {
                    swal(res.dataAlert).then((ok) => {
                        if (res.refresh == false) {
                            window.location.reload();
                        }
                    });
                }
            }
            if (res.status == 403) {
                swal({
                    title: 'Atenção!',
                    text: "Favor preencher campo obrigatório.",
                    icon: 'warning'
                });
            }
        });
    });


    /**
     * Script de alteração de status do usuario
     */
    $(document).on('click', '.btn-activation', function (e) {

        e.preventDefault();

        $('#ajaxLoader').css('display', 'flex');

        let url = $(this).data('href');
        let method = 'POST';
        let status = $(this).data('user-status');

        $.ajax({
            url : url,
            type : method,
            data : {status}
        }).done(function (res) {
            $('#ajaxLoader').css('display', 'none');
            if(res.dataAlert){
                swal({
                    title : res.dataAlert.title,
                    text : res.dataAlert.text,
                    icon : res.dataAlert.icon
                }).then((ok)=>{
                   if(res.refresh){
                       $('#ajaxLoader').css('display', 'flex');
                       window.location.reload();
                   }
                });
            }
        }).fail(function (res) {
            $('#ajaxLoader').css('display', 'none');
            if (res.responseJSON.dataAlert) {
                swal({
                    title: res.responseJSON.dataAlert.title,
                    text: res.responseJSON.dataAlert.text,
                    icon: res.responseJSON.dataAlert.icon
                }).then((ok) => {
                    if (res.responseJSON.refresh) {
                        $('#ajaxLoader').css('display', 'flex');

                        window.location.reload();
                    }
                });
            }
        });
    });




});
