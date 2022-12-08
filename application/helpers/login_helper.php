<?php

function as_admin()
{
    $ci = get_instance();
    if ($ci->session->userdata('role') != 'admin') {
        $ci->session->set_flashdata(
            'message',
            '<div class="alert alert-danger alert-dismissible fade show" 
            role="alert">
            <span class="alert-text">
            <strong>Failed!</strong> You Dont Have Access.</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        redirect('auth');
    }
}

function as_bm()
{
    $ci = get_instance();
    if ($ci->session->userdata('role') != 'beatmaker') {
        $ci->session->set_flashdata(
            'message',
            '<div class="alert alert-danger alert-dismissible fade show" 
            role="alert">
            <span class="alert-text">
            <strong>Failed!</strong> You Dont Have Access.</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        redirect('auth');
    }
}

function as_cs()
{
    $ci = get_instance();
    if ($ci->session->userdata('role') != 'customer') {
        $ci->session->set_flashdata(
            'message',
            '<div class="alert alert-danger alert-dismissible fade show" 
            role="alert">
            <span class="alert-text">
            <strong>Failed!</strong> You Dont Have Access.</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        );
        redirect('auth');
    }
}
