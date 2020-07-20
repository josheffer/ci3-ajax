<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Site extends MX_controller {

        function __construct()
        {
            parent::__construct();
            
            $this->load->model('usuarios_model', 'm_usuarios');
        }

        function index()
        {   
            $scripts = array(

                "titulo"    => "Gerenciar todos os usuários",

                "css"       => "<link href='".base_url('assets/css/bootstrap.css')."' rel='stylesheet'>
                                <link href='".base_url('assets/css/starter-template.css')."' rel='stylesheet'>",

                "js"        => "<script src='".base_url('assets/js/bootstrap.min.js')."'></script>
                                <script src='".base_url('assets/js/bootstrap.bundle.min.js')."'></script>
                                <script src='".base_url('assets/js/vendor/usuarios.js')."'></script>
                                "
            );

            $this->load->view('usuarios', $scripts);
        }

        public function c_cadastrar()
        {
            $retorno['msg'] = "";
            $sinal = false;

            $gerarCodigo = (object) array(
                'coluna' => 'id_usuario',
                'tabela' => 'usuarios'
            );
            
            $dados['id_usuario']    = $this->m_usuarios->m_gerarCodigo($gerarCodigo);
            $dados['nome_usuario']  = $this->input->post('nomeCadastrar');
            $dados['email_usuario'] = $this->input->post('emailCadastrar');
            
            if(empty($dados['nome_usuario']))
            {
                $retorno['ret'] = false;
                $retorno['msg'] .= ' O <strong class="text-uppercase">nome</strong> não pode ser vazio </br>';
                $sinal = true;
            }
            
            if(empty($dados['email_usuario']))
            {
                $retorno['ret'] = false;
                $retorno['msg'] .= ' O <strong class="text-uppercase">e-mail</strong> não pode ser vazio </br>';
                $sinal = true;

            } else {

                $email = $dados['email_usuario'];

                $pesquisarEmail = (object) array (
                    "coluna" => "*",
                    "coluna_where" => "email_usuario",
                    "valor_where" => $email,
                    "tabela" => "usuarios",
                );
                
                $emailExiste = $this->m_usuarios->m_verificar($pesquisarEmail);
                
                if($emailExiste)
                {
                    $retorno['ret'] = false;
                    $retorno['msg'] .= ' O <strong class="text-uppercase">e-mail</strong> já cadastrado no sistema </br>';
                    $sinal = true; 
                }
                
            }

            if($sinal)
            {
                echo json_encode($retorno);
                exit;
            }
            
            $tabela = 'usuarios';

            $resultado = $this->m_usuarios->criar($dados, $tabela);

            if($resultado)
            {
                $retorno['ret'] = true;
                $retorno['msg'] = " Usuário: <strong><i><u>".$dados['nome_usuario']."</u></i></strong> cadastrado com sucesso";
                echo json_encode($retorno);

            } else {

                $retorno['ret'] = false;
                $retorno['msg'] = " Não foi possível cadastrar o usuário";
                echo json_encode($retorno);
            }
            
        }
        
        public function c_listarUsuarios()
        {
            $dados = array(
                'coluna' => '*',
                'tabela' => 'usuarios',
                'coluna_where' => 'id_usuario',
                'orderBy' => 'DESC'
            );
            
            $resultado = $this->m_usuarios->m_buscar_tudo($dados);

            echo json_encode($resultado);
        }

        public function c_atualizar()
        {
            $retorno['msg']    = "";
            $sinal      = false;
            
            $id = $this->input->post('id_editar');

            $pesquisar = (object) array(
                'coluna'        => '*',
                'tabela'        => 'usuarios',
                'coluna_where'  => 'id_usuario',
                'valor_where'   => $id,
            );

            $usuarioExiste = $this->m_usuarios->m_verificar($pesquisar);

            if(empty($usuarioExiste))
            {
                $retorno['ret'] = false;
                $retorno['msg'] = 'Usuário não encontrado, tente novamente.. </br>';
                $sinal = true;
                
            } else {

                $dados['id_usuario'] = $id;
                $dados['nome_usuario'] = $this->input->post('nome_editar');
                $dados['email_usuario'] = $this->input->post('email_editar');

                if(empty($dados['nome_usuario']))
                {
                    $retorno['ret'] = false;
                    $retorno['msg'] .= ' O <strong class="text-uppercase">nome</strong> não pode ser vazio </br>';
                    $sinal = true;
                }

                if(empty($dados['email_usuario']))
                {
                    $retorno['ret'] = false;
                    $retorno['msg'] .= ' O <strong class="text-uppercase">e-mail</strong> não pode ser vazio </br>';
                    $sinal = true;

                } else {

                    $email = $dados['email_usuario'];

                    $pesquisarEmail = (object) array(
                        "coluna"        => "*",
                        "coluna_where"  => "email_usuario",
                        "valor_where"   => $email,
                        "tabela"        => "usuarios",
                    );

                    $emailExiste = $this->m_usuarios->m_verificar($pesquisarEmail);

                    if(!is_null($emailExiste))
                    {
                        if($emailExiste->id_usuario != $dados['id_usuario'])
                        {
                            $retorno['ret'] = false;
                            $retorno['msg'] .= ' O <strong class="text-uppercase">e-mail</strong> está sendo utilizado pelo usuário: <u><i><strong>'. $emailExiste->nome_usuario .'</strong></i></u>! Use outro. </br>';
                            $sinal = true;
                        }
                    }

                    if($sinal)
                    {
                        echo json_encode($retorno);
                        exit;
                    }

                }
                
            }

            if($sinal)
            {
                echo json_encode($retorno);
                exit;
            }

            $infosDB = (object) array(
                "coluna_where"  => "id_usuario",
                "valor_where"   => $id,
                "tabela"        => "usuarios"
            );

            $resultado = $this->m_usuarios->m_atualizar($dados, $infosDB);
            
            if($resultado)
            {
                $retorno['ret'] = true;
                $retorno['msg'] = ' Dados de usuário <strong class="text-uppercase">'.$dados['nome_usuario'].'</strong> atualizados com sucesso!';
                echo json_encode($retorno);
                
            } else {

                $retorno['ret'] = false;
                $retorno['msg'] = ' Não poissível atualizar os dados do usuário: <strong class="text-uppercase">'.$dados['nome_usuario'].'</strong>, tente novamente mais tarde!';
                echo json_encode($retorno);

            }

            
        }

        public function c_deletar()
        {
            $retorno['msg'] = "";
            $sinal = false;
            
            $id = $this->input->post('id_deletar');

            $pesquisar = (object) array(
                "coluna" => "*",
                "tabela" => "usuarios",
                "coluna_where" => "id_usuario",
                "valor_where" => $id
            );

            $result = $this->m_usuarios->m_verificar($pesquisar);
            
            if(is_null($result))
            {
                $retorno['ret'] = false;
                $retorno['msg'] = ' Usuário não encontrado, em alguns minutos!';
                $sinal =  true;

            } else {

                $infosDB = (object) array(
                    "tabela"        => "usuarios",
                    "coluna_where"  => "id_usuario",
                    "valor_where"   => $id
                );

                $resultado = $this->m_usuarios->m_excluir($infosDB);

                if($resultado)
                {

                    $retorno['ret'] = true;
                    $retorno['msg'] = " Usuário <strong>".$result->nome_usuario."</strong> apagado com sucesso!";
                    echo json_encode($retorno);

                } else {

                    $retorno['ret'] = false;
                    $retorno['msg'] = " Não foi possível apagar o usuário: <strong>".$result->nome_usuario."</strong>, tente em alguns minutos!";
                    echo json_encode($retorno);
                }

            }

            if($sinal)
            {
                echo json_encode($retorno);
                exit;
            }

        }
        
    } 