<?php
defined('BASEPATH') or exit('No direct script access allowed');
class CadastrosController extends CI_Controller
{
    public function formCadastro()
    {
        $this->load->helper('form');
        $this->load->helper('url');
        return $this->load->view('cadastro/cadastrar_editar');
    }

    public function inserirCadastro()
    {
        $this->load->library('form_validation');
        $this->load->model("Cadastro");
        $cadastro = new Cadastro();
        $cadastro->setNome($this->input->post('nome'));
        $cadastro->setTelefone($this->input->post('telefone'));
        $cadastro->setEmail($this->input->post('email'));
        $cadastro->setDataNasc($this->input->post('data_nasc'));
        $cadastro->insertCadastro();
        //redirect(base_url("cadastrar"));

    }

    public function buscarCadastros()
    {
        $this->load->helper('url');
        $this->load->model("Cadastro", "cadastro");

        $lista_cadastros = $this->cadastro->getCadastrosBusca(
            $this->input->get('nome') == "" ? NULL : $this->input->get('nome'),
            $this->input->get('data_ini') == "" ? NULL : $this->input->get('data_ini'),
            $this->input->get('data_fim') == "" ? NULL : $this->input->get('data_fim')
        );

        echo json_encode($lista_cadastros);
        //$this->load->view('cadastro/listar_cadastro', $dados); 
    }

    public function listarCadastros()
    {
        $this->load->helper('url');
        $this->load->model("Cadastro", "cadastro");

        $lista_cadastros = $this->cadastro->getCadastros();

        echo json_encode($lista_cadastros);
        //$this->load->view('cadastro/listar_cadastro', $dados);
    }

    public function excluirCadastro($cad_id)
    {
        $this->load->model("Cadastro", "cadastro");
        $this->cadastro->excluir($cad_id);
    }

    public function editarCadastro($cad_id)
    {
        $this->load->helper('url');
        $this->load->model("Cadastro", "cadastro");

        $cadastro = $this->cadastro->buscarId($cad_id);
        echo json_encode(array("cadastro" => $cadastro));
        //$this->load->view("cadastro/cadastrar_editar", $dados);
    }

    public function atualizarCadastro($cad_id)
    {
        $this->load->model("Cadastro");
        $cadastro = new Cadastro();


        $cadastro->setIdCad($cad_id);
        $cadastro->setNome($this->input->post('nome'));
        $cadastro->setTelefone($this->input->post('telefone'));
        $cadastro->setEmail($this->input->post('email'));
        $cadastro->setDataNasc($this->input->post('data_nasc'));

        $cadastro->atualizar($cad_id, $cadastro);
        //redirect(base_url("editar/{$cad_id}"));

    }
}
