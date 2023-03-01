<?php

class Cadastros extends CI_Model
{

    public function insertCadastro($cadastros)
    {
        $this->db->insert('cadastro', $cadastros);
    }

    public function getCadastrosBusca($nome, $dataIni, $dataFim)
    {
        
        $query = "";
        //Verifica cada valor pra saber se está vazio ou não, e monta a query dinamicamente.
        if (!is_null($nome)) {
            $query = "nome LIKE '%$nome%' ";//Espaço no final caso tenha mais queries.
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
        if (is_null($nome) && (is_null($dataIni) && is_null($dataFim))) {
            return $this->db->get('cadastro')->result();
        }

        //Fazemos uma query where e o get.
        //var_dump($query);
        $this->db->where($query);
        return $this->db->get('cadastro')->result();
    }

    public function excluir($cad_id)
    {
        $this->db->where('id_cad', $cad_id);
        $this->db->delete('cadastro');
    }

    public function buscarId($cad_id)
    {
        return $this->db->get_where('cadastro', array('id_cad' => $cad_id))->row();
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
}
