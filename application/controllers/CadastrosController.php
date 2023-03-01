<?php
defined('BASEPATH') or exit('No direct script access allowed');
include './application/globalFunctions.php';

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

        $this->form_validation->set_rules('nome', 'Nome', 'required', array('required' => 'Você deve preencher o campo Nome.'));
        $this->form_validation->set_rules('telefone', 'Telefone', 'required', array('required' => 'Você deve preencher o campo telefone.'));
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', array('required' => 'Você deve preencher o campo E-mail.', 'valid_email' => 'Preencha um e-mail válido.'));
        $this->form_validation->set_rules('data_nasc', 'Data de nascimento', 'required', array('required' => 'Você deve preencher a Data de Nascimento.'));

        if ($this->form_validation->run() == false) {
            return $this->load->view('cadastro/cadastrar_editar');
        } else {

            $cadastro->setNome($this->input->post('nome'));
            $cadastro->setTelefone($this->input->post('telefone'));
            $cadastro->setEmail($this->input->post('email'));
            $cadastro->setDataNasc($this->input->post('data_nasc'));
            
            $cadastro->insertCadastro();
            redirect(base_url("cadastrar"));
        }
    }

    public function buscarCadastros()
    {
        $this->load->helper('url');
        $this->load->model("Cadastro", "cadastro");

        $dataIniPost = convertDate($this->input->get('data_ini'));
        $dataFimPost = convertDate($this->input->get('data_fim'));

        $lista_cadastros = $this->cadastro->getCadastrosBusca(
            $this->input->get('nome') == "" ? NULL : preg_replace('/[^a-zA-Z ]/g', '', $this->input->get('nome')),
            $this->input->get('data_ini') == "" ? NULL : date('Y-m-d', strtotime($dataIniPost)),
            $this->input->get('data_fim') == "" ? NULL : date('Y-m-d', strtotime($dataFimPost))
        );
        foreach ($lista_cadastros as $lista) {
            $lista->telefone = maskTel($lista->telefone);
            $lista->data_nasc = date("d/m/Y", strtotime($lista->data_nasc));
        }

        $dados = array("lista_cadastros" => $lista_cadastros);
        $this->load->view('cadastro/listar_cadastro', $dados);
    }

    public function excluirCadastro($cad_id)
    {
        $this->load->model("Cadastros");
        $this->cadastro->excluir($cad_id);
        redirect(base_url('lista'));
    }

    public function editarCadastro($cad_id)
    {
        $this->load->helper('url');
        $this->load->model("Cadastros");
        $cadastro = $this->cadastro->buscarId($cad_id);
        $cadastro->telefone = maskTel($cadastro->telefone);
        $dados = array("cadastro" => $cadastro);
        $this->load->view("cadastro/cadastrar_editar", $dados);
    }

    public function atualizarCadastro($cad_id)
    {
        $this->load->model("Cadastros");
        $this->form_validation->set_rules('nome', 'Nome', 'required', array('required' => 'Você deve preencher o campo Nome.'));
        $this->form_validation->set_rules('telefone', 'Telefone', 'required', array('required' => 'Você deve preencher o campo telefone.'));
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', array('required' => 'Você deve preencher o campo E-mail.', 'valid_email' => 'Preencha um e-mail válido.'));
        $this->form_validation->set_rules('data_nasc', 'Data de nascimento', 'required', array('required' => 'Você deve preencher a Data de Nascimento.'));

        if ($this->form_validation->run() === false) {
            $this->editarCadastro($cad_id);
        } else {
            $telefone = preg_replace('/[^0-9]/', '', $this->input->post('telefone'));

            $data_nasc = convertDate($this->input->post('data_nasc'));
            $data = [
                'nome' => preg_replace('/[^a-zA-Z ]/g', '', $this->input->post('nome')),
                'telefone' => $telefone,
                'email' => $this->input->post('email'),
                'data_nasc' => date('Y-m-d', strtotime($data_nasc)),
            ];

            $this->cadastro->atualizar($cad_id, $data);
            redirect(base_url("editar/{$cad_id}"));
        }
    }
}
