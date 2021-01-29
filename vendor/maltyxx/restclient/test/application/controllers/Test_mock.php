<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_mock extends CI_Controller
{
    /**
     * Index method who simulate WS
     * @method index
     * @author Romain GALLIEN <r.gallien@santiane.fr>
     * @return void
     */
    public function index()
    {
        // Load form validation
        $this->load->library('form_validation');

        // Set datas
        $this->form_validation->set_data($this->input->input_stream());

        // Set basic rule
        $this->form_validation->set_rules('id', 'Identifiant', 'integer|is_natural_no_zero|required');

        // Set default return
        $return = array('status' => true, 'error' => null, 'value' => 'OK');

        // Launch validation
        if ($this->form_validation->run() == false) {
            $return = array('status' => false, 'error' => 'KO', 'value' => null);
        }

        // Output
        $this->output
            ->set_content_type('json')
            ->set_output(json_encode($return));
    }
}
