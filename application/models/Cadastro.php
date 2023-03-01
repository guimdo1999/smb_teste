<?php

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

    public function insertCadastro() {
        $data = array(
            'nome' => $this->nome,
            'telefone' => $this->telefone,
            'email' => $this->email,
            'data_nasc' => $this->data_nasc
        );
        $this->db->insert('cadastro', $data);
    }

    public function getCadastrosBusca($nomeBusca, $dataIni, $dataFim)
    {
        $query = "";
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
        //Se todos os valores forem nulos, fazemos um get normal.
        if (is_null($nomeBusca) && (is_null($dataIni) && is_null($dataFim))) {
            return $this->db->get('cadastro')->result();
        }

        //Fazemos uma query where e o get.
        $this->db->where($query);
        return $this->db->get('cadastro')->result();
    }

    public function excluir($cad_id)
    {
        $this->db->where('id_cad', $cad_id);
        $this->db->delete('cadastro');
    }

    public function buscarId($id)
    {
        $id = intval($id);
        return $this->db->get_where('cadastro', array('id_cad' => $id))->row();
    }

    public function atualizar($cad_id, $cadastros)
    {
        $this->db->where('id_cad', $cad_id);
        $this->db->update('cadastro', $cadastros);
        if ($this->db->affected_rows() > 0) {
            return $cad_id;
        } else {
            return NULL;
        }
    }

    //setters
    public function setNome($nome){
        $nome=preg_replace('/[^a-zA-Z ]/', '', $nome);
        $this->nome = $nome;
    }

    public function setTelefone($telefone){
        $telefone = preg_replace('/[^0-9]/', '', $telefone);
        $this->telefone = $telefone;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setDataNasc($data_nasc){
        $this->data_nasc = date('Y-m-d', strtotime(convertDate($data_nasc)));
    }
}