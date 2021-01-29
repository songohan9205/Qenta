# restclient
REST Full Client for Codeigniter 3

## Requirements

- PHP 5.3.x (Composer requirement)
- CodeIgniter 3.x.x

## Installation
### Step 1 Installation by Composer
#### Run composer
```shell
composer require maltyxx/restclient
```

### Step 2 Examples
Controller file is located in `/application/controllers/Client.php`.
```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller
{
    public function index()
    {
        $this->load
            ->add_package_path(FCPATH.'vendor/restclient')
            ->library('restclient')
            ->remove_package_path(FCPATH.'vendor/restclient');

        $json = $this->restclient->post('https://my-super-webservice.com/ws', array(
            'lastname' => 'test'
        ));

        $this->restclient->debug();
    }
}
```
