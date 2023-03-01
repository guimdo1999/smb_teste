<?php
defined('BASEPATH') or exit('No direct script access allowed');
include './application/globalFunctions.php';

class CadastrosController extends CI_Controller
{
    public function formCadastro()
    {
        $this->load->helper('form');
        return $this->load->view('cadastro/cadastrar_editar');
    }

    public function inserirCadastro()
    {
        $this->load->library('form_validation');
        $this->load->model("Cadastros", "cadastro");

        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('telefone', 'Telefone', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('data_nasc', 'Data de nascimento', 'required');

        if ($this->form_validation->run() == false) {
            return $this->load->view('cadastro/cadastrar_editar');
        } else {
            $telefone = preg_replace('/[^0-9]/', '', $this->input->post('telefone'));
            $data = [
                'nome' => $this->input->post('nome'),
                'telefone' => $telefone,
                'email' => $this->input->post('email'),
                'data_nasc' => convertDate(date('Y-m-d', strtotime($this->input->post('data_nasc')))),
            ];

            $this->cadastro->insertCadastro($data);
            redirect(base_url("cadastrar"));
        }
    }

    public function buscarCadastros()
    {
        $this->load->model("Cadastros", "cadastro");

        $dataIniPost = convertDate($this->input->get('data_ini'));
        $dataFimPost = convertDate($this->input->get('data_fim'));

        $lista_cadastros = $this->cadastro->getCadastrosBusca(
            $this->input->get('nome') == "" ? NULL : $this->input->get('nome'),
            $this->input->get('data_ini') == "" ? NULL : date('Y-m-d', strtotime($dataIniPost)),
            $this->input->get('data_fim') == "" ? NULL : date('Y-m-d', strtotime($dataFimPost))
        );
        $dados = array("lista_cadastros" => $lista_cadastros);
        $this->load->view('cadastro/listar_cadastro', $dados);
    }

    public function excluirCadastro($cad_id)
    {
        $this->load->model("Cadastros", "cadastro");
        $this->cadastro->excluir($cad_id);
        redirect(base_url('lista'));
    }

    public function editarCadastro($cad_id)
    {
        $this->load->model("Cadastros", "cadastro");
        $cadastro = $this->cadastro->buscarId($cad_id);
        function maskTel($telefone)
        {
            $telefoneFormatado = preg_replace('/[^0-9]/', '', $telefone);
            $combina = [];
            preg_match('/^([0-9]{2})([0-9]{4,5})([0-9]{4})$/', $telefoneFormatado, $combina);
            if ($combina) {
                return '(' . $combina[1] . ') ' . $combina[2] . '-' . $combina[3];
            }

            return $telefone;
        }
        $cadastro->telefone = maskTel($cadastro->telefone);
        $dados = array("cadastro" => $cadastro);
        $this->load->view("cadastro/cadastrar_editar", $dados);
    }

    public function atualizarCadastro($cad_id)
    {
        $this->load->model("Cadastros", "cadastro");
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('telefone', 'Telefone', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('data_nasc', 'Data de nascimento', 'required');

        if ($this->form_validation->run() === false) {
            $this->editarCadastro($cad_id);
        } else {
            $telefone = preg_replace('/[^0-9]/', '', $this->input->post('telefone'));

            $data = [
                'nome' => $this->input->post('nome'),
                'telefone' => $telefone,
                'email' => $this->input->post('email'),
                'data_nasc' => $this->input->post('data_nasc'),
            ];

            $this->cadastro->atualizar($cad_id, $data);
            redirect(base_url("editar/{$cad_id}"));
        }
    }
}
