<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->add_package_path(FCPATH.'vendor/restclient');
		$this->load->library('restclient');
		$this->load->remove_package_path(FCPATH.'vendor/restclient');
	}

	//Función que carga la vista inicial
	public function index()
	{
		$datos['jugadores'] = $this->restclient->get('https://www.balldontlie.io/api/v1/players', array());
		$this->load->view('index', $datos);
	}

	//Función que muestra los datos de acuerdo al número de página ingresado
	public function buscarPagina(){
		$pag = $this->input->post('pagina');
		$datos['jugadores'] = $this->restclient->get('https://www.balldontlie.io/api/v1/players', array(
			'page' => $pag
		));
		echo json_encode($datos);
	}

	//Función que permite la búsqueda de un jugador por su ID
	public function datosJugador(){
		$id = $this->input->post('jugId');
		$datos['jugadores'] = $this->restclient->get('https://www.balldontlie.io/api/v1/players/'.$id, array());
		echo json_encode($datos);
	}

	//Función que trae los ddatos de los jugadores que el filtro coincida en nombre o apellido
	public function filtroDatos(){
		$clave = $this->input->post('palabra');
		$datos['jugadores'] = $this->restclient->get('https://www.balldontlie.io/api/v1/players', array(
			'search' => $clave
		));
		echo json_encode($datos);
	}
	
}
