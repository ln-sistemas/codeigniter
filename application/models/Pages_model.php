<?php

class Pages_model extends CI_Model {

    private $table_name = "pages";

    public function __construct(){
        // Carrega o db
        parent::__construct();
        $this->load->database();
    }

    public function get($id = NULl){
		//Pegar a tabela pages do banco de dados e listar tudo
        if($id === null) {
            $query = $this->db->get($this->table_name);
            return $query->result();
        }
        // Get where na table page pegando um único id
        $query = $this->db->get_where($this->table_name, ['id'=>$id]);
        // first_row retorna apenas a primeira linha
        return $query->first_row();
	}

	public function new(){
		// Carrega o helper para gerar URL
		$this->load->helper('url');
		// Pega dados de um formulário
        $slug = url_title($this->input->post('title'), 'dash', true);

        // Armazena as informações do formulario
        $data = [
            'title' => $this->input->post('title'),
            'body' => $this->input->post('title'),
            'slug' => $slug
        ];
        // Insere no banco de datos na coluna page as informações da variavel data
        return $this->db->insert($this->table_name, $data);

	}

    public function update($id) {
        $this->load->helper('url');

        $slug = url_title($this->input->post('title'), 'dash', true);

        $data = [
            'title' => $this->input->post('title'),
            'body' => $this->input->post('body'),
            'slug' => $slug
        ];

        $this->db->where('id', $id);

        return $this->db->update($this->table_name, $data);

    }

    public function delete($id) {
        return $this->db->delete($this->table_name, ['id'=>$id]);
    }
}