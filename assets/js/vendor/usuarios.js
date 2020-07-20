listarUsuarios();

$('#formCadastrar').submit(function(e) 
{
    e.preventDefault();
    var dados = $(this);
    var retorno = cadastrarUsuario(dados);
});

function cadastrarUsuario(dados)
{
    $.ajax({

        type: "POST",
        data: dados.serialize(),
        url: "/cadastrar",

        dataType: 'json',

        beforeSend: function() 
        {
            $('#nomeCadastrar').prop("disabled", true);
            $('#emailCadastrar').prop("disabled", true);
            $('#botaoCadastrar').text('Aguarde.. ').append(' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').prop("disabled", true);
        },

        success: function(retorno)
        {
            
            if(retorno.ret === false) 
            {
                $('#erroMsg').html(
                    '<div class="col-md-12">' +
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        '<strong>Erro!</strong> <br>' +
                            retorno.msg +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                        '</button>' +
                        '</div>' +
                    '</div>'
                );

                $('#nomeCadastrar').prop("disabled", false);
                $('#emailCadastrar').prop("disabled", false);
                $('#botaoCadastrar').text('Tentar novamente.. ').prop("disabled", false);

                $('.alert').delay(5000).slideUp(1000, function(){ $(this).alert('close'); });
                

            } else {

                $('#erroMsg').html(
                    '<div class="col-md-12">' +
                        '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                        '<strong>Tudo certo!</strong> <br>' +
                            retorno.msg +
                        '<button type="button" id="fecharMsgSucesso" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                        '</button>' +
                        '</div>' +
                    '</div>'
                );

                
                $('#formCadastrar').each(function(){
                    this.reset();
                });

                $('#nomeCadastrar').prop("disabled", false);
                $('#emailCadastrar').prop("disabled", false);
                $('#botaoCadastrar').text('Cadastrar outro.. ').prop("disabled", false);

                $('.alert').delay(5000).slideUp(1000, function(){ $(this).alert('close'); });

                listarUsuarios();

            }
        }

    });
}

function listarUsuarios() {

    $.ajax({

        url: "/listarUsuarios",
        ajax: 'data.json',

        success: function(data) {

            var dados = JSON.parse(data);

            dadosGlobais = dados;

            $('#tabelaUsuarios').html('');

            if(dados.length > 0)
            {
                for (var i = 0; i < dados.length; i++)
                {
                    $('#tabelaUsuarios').append(
                        '<tr>' +
                            '<th>'+ dados[i].id_usuario +'</th>' +
                            '<td>'+ dados[i].nome_usuario +'</td>' +
                            '<td>'+ dados[i].email_usuario +'</td>' +
                            '<td>' +
                                '<button type="button" onclick="javascript:modalEditar('+ i +');" class="btn btn-sm btn-primary mr-2"> <i class="fas fa-user-edit"></i> Editar</button>' +
                                '<button type="button" onclick="javascript:modalApagar('+ i +');" class="btn btn-sm btn-danger"> <i class="fas fa-trash-alt"></i> Apagar</button>' +
                            '</td>' +
                        '</tr>'
                    );
                }

            } else {
                
                $('#tabelaUsuarios').append(
                    '<tr>' +
                        '<td colspan="4">'+
                            '<center class="mt-4 text-center">'+
                                '<div class="col-md-12 text-center">'+
                                    '<div class="alert alert-danger text-danger">'+
                                        'Nenum usuário cadastrado'+
                                    '</div>'+
                                '</div>'+
                            '</center>'+
                        '</td>' +
                        '</tr>' 
                );
            }

        }

    });
    
}

function modalEditar(at)
{
    $('#modalEditar').modal('show');
    
    $('#tituloNome').html(dadosGlobais[at].nome_usuario);
    $('#id_editar').val(dadosGlobais[at].id_usuario);
    $('#nome_editar').val(dadosGlobais[at].nome_usuario);
    $('#email_editar').val(dadosGlobais[at].email_usuario);

    $('#nome_editar').prop("disabled", false);
    $('#email_editar').prop("disabled", false);
    $('#botaoEditar').text('Editar').prop("disabled", false);

    $('#fecharMsgModalEditar').trigger('click');
    $('#fecharMsgSucesso').trigger('click');
    
}

$('#formEditar').submit(function(e) 
{
    e.preventDefault();
    var dados = $(this);
    var retorno = atualizarDados(dados);
});

function atualizarDados(dados)
{
    $.ajax({

        type: "POST",
        data: dados.serialize(),
        url: "/atualizar",
        dataType: 'json',

        beforeSend: function(){

            $('#nome_editar').prop("disabled", true);
            $('#email_editar').prop("disabled", true);
            $('#botaoEditar').text('Aguarde.. ').append(' <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').prop("disabled", true);

        },

        success: function(retorno)
        {
            
            if(retorno.ret === false) 
            {
                $('#erroMsgEditar').html(
                    '<div class="col-md-12">' +
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        '<strong>Erro!</strong> <br>' +
                            retorno.msg +
                        '<button type="button" id="fecharMsgModalEditar" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                        '</button>' +
                        '</div>' +
                    '</div>'
                );
                
                $('#nome_editar').prop("disabled", false);
                $('#email_editar').prop("disabled", false);
                $('#botaoEditar').text('Tentar novamente.. ').prop("disabled", false);

                $('.alert').delay(5000).slideUp(1000, function(){ $(this).alert('close'); });
                

            } else {

                $('#erroMsg').html(
                    '<div class="col-md-12">' +
                        '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                        '<strong>Tudo certo!</strong> <br>' +
                            retorno.msg +
                        '<button type="button" id="fecharMsgSucesso" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                        '</button>' +
                        '</div>' +
                    '</div>'
                );
                
                $('#formEditar').each(function(){
                    this.reset();
                });
                
                $('#nome_editar').prop("disabled", false);
                $('#email_editar').prop("disabled", false);
                $('#botaoEditar').text('Editar').prop("disabled", false);

                $('.alert').delay(5000).slideUp(1000, function(){ $(this).alert('close'); });

                $('#modalEditar').modal('hide');

                listarUsuarios();

            }
        }

    });
}

function modalApagar(del)
{
    $('#modalApagar').modal('show');

    $('.tituloApagar').html(dadosGlobais[del].nome_usuario);
    $('#id_deletar').val(dadosGlobais[del].id_usuario);

    $('#fecharMsgModalApagar').trigger('click');
    $('#fecharMsgSucesso').trigger('click');

    $('#botaoDeletar').text('Sim, quero apagar!!').prop("disabled", false);
    
}

$('#formDeletar').submit(function(e) 
{
    e.preventDefault();
    var dados = $(this);
    var retorno = deletarDados(dados);
});

function deletarDados(dados)
{
    $.ajax({

        type: "POST",
        data: dados.serialize(),
        url: "/deletar",
        dataType: 'json',

        beforeSend: function()
        {
            $('#botaoDeletar').text('Aguarde..').append('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>').prop("disabled", true);
        },

        success: function(retorno)
        {
            
            if(retorno.ret === false) 
            {
                $('#erroMsgApagar').html(
                    '<div class="col-md-12">' +
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        '<strong>Erro!</strong> <br>' +
                            retorno.msg +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                        '</button>' +
                        '</div>' +
                    '</div>'
                );
                
                $('#botaoDeletar').text('Tentar novamente.. ').prop("disabled", false);

                $('.alert').delay(5000).slideUp(1000, function(){ $(this).alert('close'); });
                

            } else {

                $('#erroMsg').html(
                    '<div class="col-md-12">' +
                        '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                        '<strong>Tudo certo!</strong> <br>' +
                            retorno.msg +
                        '<button type="button" id="fecharMsgSucesso" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span>' +
                        '</button>' +
                        '</div>' +
                    '</div>'
                );
                
                $('#botaoDeletar').text('Sim, quero apagar!!').prop("disabled", false);

                $('.alert').delay(5000).slideUp(1000, function(){ $(this).alert('close'); });

                $('#modalApagar').modal('hide');

                listarUsuarios();

            }
        }

    });
}