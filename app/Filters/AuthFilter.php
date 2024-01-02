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
        $segment2 = ($request->uri->getTotalSegments() > 1) ? $request->uri->getSegment(2) : NULL;
        $segment3 = ($request->uri->getTotalSegments() > 2) ? $request->uri->getSegment(3) : NULL;


        if (!$session->has('id_user')) {
            $alert->set('warning', 'Warning', 'User Not Login');
            return redirect()->to(base_url('auth'));
        }

        if ($segment == 'user') {
            if (session()->get('id_role') != 1) {
                $alert->set('warning', 'Warning', 'User Not Access');
                return redirect()->to(base_url('dashboard'));
            }
        }

        if (($segment == 'surat') && ($segment2 == 'kategori')) {
            if (session()->get('id_role') == 4 || session()->get('id_role') == 3) {
                $alert->set('warning', 'Warning', 'User Not Access');
                return redirect()->to(base_url('dashboard'));
            }
        }

        if (($segment == 'surat') && ($segment2 == 'masuk')) {
            if (session()->get('id_role') == 4) {
                $alert->set('warning', 'Warning', 'User Not Access');
                return redirect()->to(base_url('dashboard'));
            }
        }

        if (($segment == 'helpdesk') && ($segment2 == 'kategori')) {
            if (session()->get('id_role') == 4 || session()->get('id_role') == 3) {
                $alert->set('warning', 'Warning', 'User Not Access');
                return redirect()->to(base_url('dashboard'));
            }
        }

        // filter menu asset

        if (($segment == 'asset') && ($segment2 == 'item')) {
            if (session()->get('id_role') == 4 || session()->get('id_role') == 3) {
                $alert->set('warning', 'Warning', 'User Not Access');
                return redirect()->to(base_url('dashboard'));
            }
        }

        if (($segment == 'asset') && ($segment2 == 'status')) {
            if (session()->get('id_role') == 4 || session()->get('id_role') == 3) {
                $alert->set('warning', 'Warning', 'User Not Access');
                return redirect()->to(base_url('dashboard'));
            }
        }

        if (($segment == 'asset') && ($segment2 == 'kategori')) {
            if (session()->get('id_role') == 4 || session()->get('id_role') == 3) {
                $alert->set('warning', 'Warning', 'User Not Access');
                return redirect()->to(base_url('dashboard'));
            }
        }

        if (($segment == 'asset') && ($segment2 == 'barang')) {
            if (session()->get('id_role') == 4 || session()->get('id_role') == 3) {
                $alert->set('warning', 'Warning', 'User Not Access');
                return redirect()->to(base_url('dashboard'));
            }
        }

        if (($segment == 'asset') && ($segment2 == 'pinjam') && ($segment3 == 'status')) {
            if (session()->get('id_role') == 4 || session()->get('id_role') == 3) {
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
