<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Usuarios_model extends CI_Model {

        function __construct()
        {
            parent::__construct();
            
        }
        
        public function m_gerarCodigo($dados)
        {
            $result = $this->db->query("SELECT MAX($dados->coluna) AS codigo FROM $dados->tabela");

            foreach ($result->result_array() as $valor) 
            {
                if(is_null($valor['codigo'])) return 1;

                return intval($valor['codigo'])+1;
            }
        }

        public function m_verificar($dados)
        {
            $this->db->select($dados->coluna);
            $this->db->where($dados->coluna_where, $dados->valor_where);

            $resultado = $this->db->get($dados->tabela)->result();

            if(is_null($resultado))
            {
                return $resultado;

            } else  {

                foreach ($resultado as $valor) {
                    
                    return $valor;

                }
            }
        }

        public function criar($dados, $tabela)
        {
            return $this->db->insert($tabela, $dados);
        }
        
        public function m_buscar_tudo($dados)
        {
            $objeto = (object)$dados;

            $this->db->select($objeto->coluna);
            $this->db->order_by($objeto->coluna_where, $objeto->orderBy);

            $resultado = $this->db->get($objeto->tabela)->result();

            return $resultado;
        }

        public function m_atualizar($dados, $infosDB)
        {
            $this->db->where($infosDB->coluna_where, $infosDB->valor_where);
            $resultado = $this->db->update($infosDB->tabela, $dados);

            return $resultado;
        }

        public function m_excluir($dados)
        {  
            $this->db->where($dados->coluna_where, $dados->valor_where);
            
            $resultado = $this->db->delete($dados->tabela);

            return $resultado;
        }
        
    }