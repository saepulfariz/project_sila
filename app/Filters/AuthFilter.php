<?php



namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {

        $session = session();
        $request = \Config\Services::request();
        $alert = new \App\Libraries\Alert();

        $segment = $request->uri->getSegment(1);


        if (!$session->has('id_user')) {
            $alert->set('warning', 'Warning', 'User Not Login');
            return redirect()->to(base_url('auth'));
        }

        if ($segment == 'user') {
            if (session()->get('id_role') == 2) {
                $alert->set('warning', 'Warning', 'User Not Access');
                return redirect()->to(base_url('dashboard'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
