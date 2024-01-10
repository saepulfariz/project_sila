<!doctype html>
<html lang="en">

<?php

$alert = new App\Libraries\Alert();

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?> | SILA</title>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/front/css/bootstrap.min.css">


    <link rel="stylesheet" href="<?= base_url(); ?>assets/front/font/bootstrap-icons.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/front/owl/assets/owl.carousel.min.css">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/front/css/style.css">
    <?= $this->renderSection('head'); ?>
</head>

<body id="home">
    <?= $alert->get(); ?>

    <?= $this->include('template/front/navbar'); ?>

    <?= $this->renderSection('content'); ?>



    <script src="<?= base_url(); ?>assets/front/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe">
    </script>

    <script src="<?= base_url(); ?>assets/front/js/jquery-3.6.4.js"></script>
    <script src="<?= base_url(); ?>assets/front/owl/owl.carousel.min.js"></script>



    <?= $alert->init('jquery'); ?>


    <script src="<?= base_url(); ?>assets/front/js/script.js"></script>

    <?= $this->renderSection('script'); ?>
</body>

</html>