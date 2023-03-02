<?php
include './application/globalFunctions.php';
class Cadastro extends CI_Model
{

    // Define a tabela correspondente no banco de dados
    protected $table = 'cadastro';

    // Define as propriedades correspondentes às colunas da tabela
    protected $id_cad;
    protected $nome;
    protected $telefone;
    protected $email;
    protected $data_nasc;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertCadastro()
    {
        $data = array(
            'nome' => $this->nome,
            'telefone' => $this->telefone,
            'email' => $this->email,
            'data_nasc' => $this->data_nasc
        );
        $this->db->insert('cadastro', $data);
    }

    public function getCadastros()
    {
        $lista_cadastros = $this->db->get('cadastro')->result();
        foreach ($lista_cadastros as $lista) {
            $lista->telefone = maskTel($lista->telefone);
            $lista->data_nasc = date("d/m/Y", strtotime($lista->data_nasc));
        }
        return $lista_cadastros;
    }

    public function getCadastrosBusca($nomeBusca, $dataIni, $dataFim)
    {
        $query = "";

        if (is_null($nomeBusca) || $nomeBusca == '') {
            $nomeBusca = NULL;
        } else {
            $nomeBusca = preg_replace('/[^a-zA-Z ]/', '', $nomeBusca);
        }
        if (is_null($dataIni) || $dataIni == '') {
            $dataIni = NULL;
        } else {
            $dataIni = date('Y-m-d', strtotime(convertDate($dataIni)));
        }
        if (is_null($dataFim) || $dataFim == '') {
            $dataFim = NULL;
        } else {
            $dataFim = date('Y-m-d', strtotime(convertDate($dataFim)));
        }

        //Verifica cada valor pra saber se está vazio ou não, e monta a query dinamicamente.
        if (!is_null($nomeBusca)) {
            $query = "nome LIKE '%$nomeBusca%' "; //Espaço no final caso tenha mais queries.
        }
        if (is_null($dataIni) && !is_null($dataFim)) {

            $query .= $query == "" ? "data_nasc < '$dataFim'" : "AND data_nasc < '$dataFim'";
        }
        if (!is_null($dataIni) && is_null($dataFim)) {
            $query .= $query == "" ? "data_nasc > '$dataIni'" : "AND data_nasc > '$dataIni'";
        }
        //Monta diferente que de cima caso os dois valores de data estejam preenchidos, usando BETWEEN.
        if (!is_null($dataIni) && !is_null($dataFim)) {
            $query .= $query == "" ? "data_nasc BETWEEN '$dataIni' AND '$dataFim'" : "AND (data_nasc BETWEEN '$dataIni' AND '$dataFim')";
        }
        //Se a query não estiver vazia, a executamos para o get.
        if ($query != '') {
            $this->db->where($query);
        }

        $lista_cadastros = $this->db->get('cadastro')->result();
        foreach ($lista_cadastros as $lista) {
            $lista->telefone = maskTel($lista->telefone);
            $lista->data_nasc = date("d/m/Y", strtotime($lista->data_nasc));
        }
        return $lista_cadastros;
    }

    public function excluir($cad_id)
    {
        $this->db->where('id_cad', $cad_id);
        $this->db->delete('cadastro');
    }

    public function buscarId($id)
    {
        $id = intval($id);
        $cadastro = $this->db->get_where('cadastro', array('id_cad' => $id))->row();
        $cadastro->telefone = maskTel($cadastro->telefone);
        return $cadastro;
    }

    public function atualizar($cad_id, $cadastro)
    {
        $this->db->where('id_cad', $cad_id);

        $this->db->set('nome', $cadastro->getNome());
        $this->db->set('telefone', $cadastro->getTelefone());
        $this->db->set('email', $cadastro->getEmail());
        $this->db->set('data_nasc', $cadastro->getDataNasc());

        $this->db->update('cadastro');

        if ($this->db->affected_rows() > 0) {
            return $cad_id;
        } else {
            return NULL;
        }
        $this->db->update('cadastro', $cadastro);
        if ($this->db->affected_rows() > 0) {
            return $cad_id;
        } else {
            return NULL;
        }
    }

    //setters
    public function setIdCad($id_cad)
    {

        $this->id_cad = $id_cad;
    }
    public function setNome($nome)
    {
        $nome = preg_replace('/[^a-zA-Z ]/', '', $nome);
        $this->nome = $nome;
    }

    public function setTelefone($telefone)
    {
        $telefone = preg_replace('/[^0-9]/', '', $telefone);
        $this->telefone = $telefone;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setDataNasc($data_nasc)
    {
        $this->data_nasc = date('Y-m-d', strtotime(convertDate($data_nasc)));
    }

    //Getters
    public function getNome()
    {
        return $this->nome;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getDataNasc()
    {
        return $this->data_nasc;
    }
}