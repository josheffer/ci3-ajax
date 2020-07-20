<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['modules_locations'] = array(
    APPPATH.'modules/' => '../modules/',
);

$route['default_controller']    = 'site';
$route['404_override']          = '';
$route['translate_uri_dashes']  = FALSE;

$route['cadastrar']['post']     = 'site/c_cadastrar';
$route['atualizar']['post']     = 'site/c_atualizar';
$route['deletar']['post']       = 'site/c_deletar';

$route['listarUsuarios']        = 'site/c_listarUsuarios';
