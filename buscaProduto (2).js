$(function() {
    $("#buscar").click(function() {

        var codigo = $("#codigo").val();

        $.ajax({
            type: "GET",
            url: "/bazar/buscaProduto.php",
            data: { codigo },
            dataType: "json",
            success: (result,status) => {
                console.log(result);
                console.log(status);
                $("#descricao").val( result.descricao);
                $("#preco").val( new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(
                    result.preco
                  ));
            },
            error: (xhr,status,error) => {
                console.warn(xhr);
                console.warn(status);
                console.warn(error);

                // Sessão expirada ou usuário não autenticado -> volta para o login
                if(xhr.status === 401) {
                    window.location.href = "/bazar/login.php";
                    return;
                }

                const modal = bootstrap.Modal.getOrCreateInstance('#modal');
                if(xhr.status === 404) {
                    $("#mensagemModal").html("Produto não existe");
                } else {
                    $("#mensagemModal").html("Erro ao consultar produto!");
                };
                modal.show();                 
            }
        });
    });

    $("#codigo").change(function() {
        $("#descricao").val("");
        $("#preco").val("");
    });
});
