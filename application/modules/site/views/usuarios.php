<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">

    <title>
        <?=$titulo?>
    </title>
    
    <?=$css?>
	
    
  </head>

  <body>
    
    <div class="mt-3 fixed-top" style="position: absolute !important; z-index: 999999999;">
        <div id="erroMsg"></div>
    </div>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      
      <a class="navbar-brand" href="javascript:void(0);">Sisteminha</a>
      
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          
          <li class="nav-item active">
            <a class="nav-link" href="#">Início</a>
          </li>
          
        </ul>
        
      </div>

    </nav>

    <main role="main" class="container">

      <div class="">
        
        <section>
          
          <form id="formCadastrar">

            <h4>Cadastrar usuário</h4>
            
            <div class="row mt-4 mb-4">
      
              <div class="col-md-4">
                <input type="text" name="nomeCadastrar" id="nomeCadastrar" class="form-control" placeholder="Nome" autocomplete="off">
              </div>
      
              <div class="col-md-5">
                <input type="text" name="emailCadastrar" id="emailCadastrar" class="form-control" placeholder="E-mail" autocomplete="off">
              </div>
      
              <div class="col-md-3">
                <button type="submit" id="botaoCadastrar" class="btn btn-block btn-primary">Cadastrar</button>
              </div>
      
            </div>
      
            <hr class="mt-2">
      
          </form>
        </section>
        
        <section>

          <h4>Usuários cadastrados</h4>

          <table class="table mt-4 table-bordered table-hover table-striped">
            
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">Ações</th>
              </tr>
            </thead>

            <tbody id="tabelaUsuarios"></tbody>

          </table>

        </section>

      </div>

    </main>

    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Alterar usuário: <u><i><strong>Josheffer</strong></i></u></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form id="formEditar">

          <div class="mt-3" id="erroMsgEditar"></div>

            <div class="modal-body">
            
                <input type="hidden" name="id_editar" id="id_editar">

                <div class="row mt-4 mb-4">
        
                  <div class="col-md-6">
                    <input type="text" name="nome_editar" id="nome_editar" class="form-control" placeholder="Nome">
                  </div>
          
                  <div class="col-md-6">
                    <input type="text" name="email_editar" id="email_editar" class="form-control" placeholder="E-mail">
                  </div>
                  
                </div>
                
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Editar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
            </div>

          </form>

        </div>

      </div>

    </div>

    <div class="modal fade" id="modalApagar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Apagar usuário: <u><i><strong class="tituloApagar"></strong></i></u></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <form id="formDeletar">

            <div class="mt-3" id="erroMsgApagar"></div>

            <input type="hidden" name="id_deletar" id="id_deletar">

            <div class="modal-body">
                <p>Deseja realmente apagar o usuário: <u><i><strong class="tituloApagar"></strong>?</i></u></p>
                <p>Não será possível reverter essa ação após confirmada!</p>
            </div>

            <div class="modal-footer">
              <button type="submit" id="botaoDeletar" class="btn btn-danger">Sim, quero apagar!!</button>
              <button type="button" class="btn btn-info" data-dismiss="modal">Fechar</button>
            </div>

          </form>

        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js"></script>
    <?=$js?>

  </body>

</html>
