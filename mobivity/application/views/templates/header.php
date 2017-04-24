<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Contact Database - <?php echo $title; ?></title>
    <!-- jQuery -->
    <script src="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>

        var getUrl = window.location;
        var base_url = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

        function delContact(id) {
                if (confirm("Are you sure you want to delete?")) {
                        $.ajax({
                        url: base_url + '/contacts/delete/'+ id,
                        type: 'post',
                        success: function () {
                        },
                        error: function () {
                                alert('failure to complete task.');
                        }
                        });
                } else {
                        alert(id + " not deleted");
                }
        }
    </script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>">Contact Database</a>
            </div>
            <!-- /.navbar-header -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>/index.php/contacts/"><i class="fa fa-dashboard fa-fw"></i> Contacts</a>
                        </li>
                        <li>
                            <a href="<?php echo "http://" . $_SERVER['SERVER_NAME']; ?>/index.php/contacts/reports/"><i class="fa fa-bar-chart-o fa-fw"></i> Reports</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>


        <div id="page-wrapper">
