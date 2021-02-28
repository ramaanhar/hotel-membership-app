<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $idrole = $ci->session->userdata('idrole');
        $menu = $ci->uri->segment(1);
        $queryMenu = $ci->db->get_where('roles', ['role' => $menu])->row_array();
        $idmenu = $queryMenu['idrole'];
        $userAccess = $ci->db->get_where(
            'useraccess',
            [
                'idrole' => $idrole,
                'idmenu' => $idmenu
            ]
        );
        if ($userAccess->num_rows() < 1) {
            redirect('auth/denied');
        }
    }
}
