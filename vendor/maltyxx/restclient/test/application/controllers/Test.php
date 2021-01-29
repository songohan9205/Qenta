<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller
{
    /**
     * Main method for unit testing
     * @method index
     * @author Romain GALLIEN <r.gallien@santiane.fr>
     * @return string
     */
    public function index()
    {
        // We load unit test lib
        $this->load->library('unit_test');

        // We load restclient library
        $this->load
            ->add_package_path(FCPATH.'vendor/santiane/restclient')
            ->library('restclient')
            ->remove_package_path(FCPATH.'vendor/santiane/restclient');

        // WS Call GET
        $valid_get = $this->restclient->get(UNIT_TEST_URL, array('id' => 4166197));
        $invalid_get = $this->restclient->get(UNIT_TEST_URL, array('id' => '42434zefzefze'));

        // WS Call PUT
        $valid_put = $this->restclient->put(UNIT_TEST_URL, array('id' => 4166197));
        $invalid_put = $this->restclient->put(UNIT_TEST_URL, array('id' => '42434zefzefze'));

        // WS Call POST
        $valid_post = $this->restclient->post(UNIT_TEST_URL, array('id' => 4166197));
        $invalid_post = $this->restclient->post(UNIT_TEST_URL, array('id' => '42434zefzefze'));

        // WS Call PATCH
        $valid_patch = $this->restclient->patch(UNIT_TEST_URL, array('id' => 4166197));
        $invalid_patch = $this->restclient->patch(UNIT_TEST_URL, array('id' => '42434zefzefze'));

        // WS Call DELETE
        $valid_delete = $this->restclient->delete(UNIT_TEST_URL, array('id' => 4166197));
        $invalid_delete = $this->restclient->delete(UNIT_TEST_URL, array('id' => '42434zefzefze'));

        // Unit test GET
        $this->unit->run($valid_get['status'] === true, 'is_true', 'Appel GET valide (status)');
        $this->unit->run($valid_get['value'] === 'OK', 'is_true', 'Appel GET valide (value)');
        $this->unit->run($invalid_get['status'] === false, 'is_true', 'Appel GET invalide (status)');
        $this->unit->run($invalid_get['error'] === 'KO', 'is_true', 'Appel GET invalide (value)');

        // Unit test PUT
        $this->unit->run($valid_put['status'] === true, 'is_true', 'Appel PUT valide (status)');
        $this->unit->run($valid_put['value'] === 'OK', 'is_true', 'Appel PUT valide (value)');
        $this->unit->run($invalid_put['status'] === false, 'is_true', 'Appel PUT invalide (status)');
        $this->unit->run($invalid_put['error'] === 'KO', 'is_true', 'Appel PUT invalide (value)');

        // Unit test POST
        $this->unit->run($valid_post['status'] === true, 'is_true', 'Appel POST valide (status)');
        $this->unit->run($valid_post['value'] === 'OK', 'is_true', 'Appel POST valide (value)');
        $this->unit->run($invalid_post['status'] === false, 'is_true', 'Appel POST invalide (status)');
        $this->unit->run($invalid_post['error'] === 'KO', 'is_true', 'Appel POST invalide (value)');

        // Unit test PATCH
        $this->unit->run($valid_patch['status'] === true, 'is_true', 'Appel PATCH valide (status)');
        $this->unit->run($valid_patch['value'] === 'OK', 'is_true', 'Appel PATCH valide (value)');
        $this->unit->run($invalid_patch['status'] === false, 'is_true', 'Appel PATCH invalide (status)');
        $this->unit->run($invalid_patch['error'] === 'KO', 'is_true', 'Appel PATCH invalide (value)');

        // Unit test DELETE
        $this->unit->run($valid_delete['status'] === true, 'is_true', 'Appel DELETE valide (status)');
        $this->unit->run($valid_delete['value'] === 'OK', 'is_true', 'Appel DELETE valide (value)');
        $this->unit->run($invalid_delete['status'] === false, 'is_true', 'Appel DELETE invalide (status)');
        $this->unit->run($invalid_delete['error'] === 'KO', 'is_true', 'Appel DELETE invalide (value)');

        // Let's run tests ! :D
        $tests = $this->unit->result();

        $error = false;

        // We try to fetch any error
        if (!empty($tests)) {
            foreach ($tests as $test) {
                if ($test['Result'] !== 'Passed') {
                    $error = true;
                    echo 'An error has occured for test : '.$test['Test Name'].PHP_EOL;
                    continue;
                }

                echo 'Test successfully passed : '.$test['Test Name'].PHP_EOL;
            }

            if ($error === true) {
                exit(EXIT_ERROR);
            }
        }
    }
}
