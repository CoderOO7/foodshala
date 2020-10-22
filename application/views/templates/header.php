<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodshala</title>

    <link rel="stylesheet" href="https://bootswatch.com/4/simplex/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/style.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="<?php echo site_url() ?>">FoodShala</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo site_url() ?>">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url(); ?>menu/view">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url(); ?>about">About</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url(); ?>contact">Contact</a>
                </li> -->
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php if(! $this->session->has_userdata('is_logged_in')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url(); ?>login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url(); ?>register-customer">Register Customer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url(); ?>register-restaurant">Register Restaurant</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo site_url(); ?>logout">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>