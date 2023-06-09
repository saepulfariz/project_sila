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
                        <a class="nav-link active" aria-current="page" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#helpdesk">Helpdesk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#log">Log</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#surat">Surat</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('auth'); ?>">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>