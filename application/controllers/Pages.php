<?php 

class Pages extends CI_Controller {

    public function __construct(){
        // Incluir o parente construct para evitar erros e sobreescrever métodos
        parent::__construct();
        // Chamar o model através do construtor
        $this->load->model('pages_model');
    }

    public function index() {
		// Carregar o model - nome do model minusculo

		// Chamar o metodo get criado no model, serve para listar os dados;
		$results = $this->pages_model->get();

		$this->load->view("template/header.php");

		// Passar o results para a view através de um array
		$this->load->view("pages/index.php", ['pages'=> $results]);
		$this->load->view("template/footer.php");
	}

	public function view($id) {
        $page = $this->pages_model->get($id);
	}

	public function new(){
	    // Carregar a biblioteca de validação formulário
	    $this->load->library("form_validation");
        // Validar o campo title como obrigatório
	    $this->form_validation->set_rules('title', 'Título', 'required');
	    $this->form_validation->set_rules('body', 'Conteúdo', 'required');

	    if($this->form_validation->run() === false){
            $this->load->view("template/header.php");
            $this->load->view("pages/new");
            $this->load->view("template/footer.php");
        } else {
	        // Criar uma url de retorno
	        $data['back'] = '/pages';
	        // Carregar o model de nova pagina
	        $this->pages_model->new();
	        // Carregar a view sucess
	        $this->load->view("template/success", $data);
        }
	}

	public function edit($id = NULL) {
		$this->load->library("form_validation");

		$this->form_validation->set_rules('title', 'Título', 'required');
		$this->form_validation->set_rules('body', 'Conteúdo', 'required');

		if($this->form_validation->run() === false) {
			$page = $this->pages_model->get($id);
			$this->load->view("template/header");
			$this->load->view("pages/edit", ['page'=> $page]);
			$this->load->view("template/footer");
		} else {
			$data['back'] = "/pages/$id";
			$this->pages_model->update($id);
			$this->load->view("template/success", $data);
		}

	}

	public function delete($id){
		$this->pages_model->get($id);
		$data['back']= "/pages";
		$this->pages_model->delete($id);
		$this->load->view("template/success", $data);
	}
}