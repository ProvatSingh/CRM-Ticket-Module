<?php include __DIR__ . "/components/user-session-start.php"; ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> CRM Ticket Module</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="/CRM-Ticket-Module/assets/css/tom-select.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.min.css"> -->
    <link rel="stylesheet" href="/CRM-Ticket-Module/assets/css/main.css">
</head>

<body>
    <header class="header">

        <div class="container-fluid p-0">

            <nav class="navbar d-flex">
                <a class="navbar-brand" href="/CRM-Ticket-Module/index.php">
                    CRM Ticket Module
                </a>

                <div class="menu-overlay" id="menu_overlay"></div>

                <div class="collapse-menu" id="collapse_menu">

                    <div class="responsive-logo">
                        <a href="/CRM-Ticket-Module/index.php">
                            <!-- <img class="logo-desktop" src="images/logo.svg" alt="logo"> -->
                        </a>
                    </div>

                    <div class="mobile-scroll">
                        <div class="primary-nav non-default-ul">
                            <ul id="myUL" class="navbar-nav">

                                <li class=""><a href="/CRM-Ticket-Module/index.php">Home</a></li>
                                <li class=""><a href="/CRM-Ticket-Module/tickets/create.php">Create Ticket</a></li>
                                <li class="menu-item-has-children">
                                    <a href="javascript:void(0);">my tickets</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/CRM-Ticket-Module/tickets/created-list.php">Created tickets</a></li>
                                        <li><a href="/CRM-Ticket-Module/tickets/assigned-list.php">Assigned tickets</a></li>
                           
                                    </ul>
                                </li>
                                <li class=""><a href="/CRM-Ticket-Module/auth/logout.php">Logout</a></li>
                                <!-- <li class=""><a href="#">investments</a></li>
                                <li class=""><a href="#">achievements</a></li>
                                <li class=""><a href="#">inspirations</a></li>
                                <li class=""><a href="#">philanthropy</a></li> -->

                            </ul>
                        </div>


                        <div class="colapse-close" id="colapse_close">
                            <!-- <img src="images/collapse-close-icon.svg" alt=""> -->
                        </div>


                    </div>

                </div>


                <div class="search-icon">search</div>

                <div class="hamburger-menu" id="hamburger_menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>


            </nav>

        </div>

    </header>