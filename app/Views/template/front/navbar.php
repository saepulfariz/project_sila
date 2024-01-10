<?php

$request = \Config\Services::request();
$segment = $request->uri->getSegment(1);
$segment2 = ($request->uri->getTotalSegments() > 1) ? $request->uri->getSegment(2) : NULL;
$segment3 = ($request->uri->getTotalSegments() > 2) ? $request->uri->getSegment(3) : NULL;

?>
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url(); ?>">
            <img src="<?= base_url(); ?>assets/front/img/logo.png" height="44px" alt="">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="m-auto">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= ($segment == '') ? 'active' : ''; ?>" aria-current="page" href="<?= base_url(); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($segment == 'helpdesk') ? 'active' : ''; ?>" href="<?= base_url('helpdesk'); ?>">Helpdesk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($segment == 'asset') ? 'active' : ''; ?>" href="<?= base_url('asset'); ?>">Asset</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($segment == 'surat') ? 'active' : ''; ?>" href="<?= base_url('surat'); ?>">Surat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($segment == 'about') ? 'active' : ''; ?>" href="<?= base_url('about'); ?>">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($segment == 'auth') ? 'active' : ''; ?>" href="<?= base_url('auth'); ?>">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>