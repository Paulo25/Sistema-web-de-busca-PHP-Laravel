$(document).ready(function (e) {

    $(document).on('submit', 'form.submit-edit', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $('#ajaxLoader').css('display', 'flex');
        var data = new FormData($(this).get(0));
        // let nome = $("input[name=nome]").val();
        // let conteudo = $("input[name=conteudo]").val();
        // let status = $("input[name=status]").val();
        // let checkbox = $("input[name=checkbox]").val();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).find('input[name="_method"]').val(),
            contentType: false,
            processData: false,
            data: data
            // data: {nome,conteudo,status,checkbox,data}
        }).done(function (res) {
            $('#ajaxLoader').css('display', 'none');
            if (res.success == true) {
                swal({
                    title: 'Solicitação efetuada com sucesso!',
                    text: 'Operação efetuada com sucesso.',
                    icon: 'success'
                }).then(function () {
                    window.location.reload();
                });
            }
        }).fail(function (res) {
            $('#ajaxLoader').css('display', 'none');
            if (res.status == 403) {
                swal({
                    title: 'Atenção!',
                    text: "Favor preencher campo obrigatório.",
                    icon: 'warning'
                });
            } else {
                swal({
                    title: 'Solicitação recusada!',
                    text: "Não foi possivel realizar esta ação.",
                    icon: 'error'
                }).then(function () {
                    window.location.reload();
                });
            }
        });
    });


});
