<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <title>Download jQuery UI Bootstrap</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="A preview of the jQuery UI Bootstrap theme.">
            <meta name="author" content="liugehao" >

            <!-- Le styles -->
            <link rel="stylesheet" href="/static/css/bootstrap.min.css">
            <link rel="stylesheet" href="/static/css/custom-theme/jquery-ui-1.10.2.custom.css">
            <link rel="stylesheet" href="/static/css/font-awesome.min.css">
            <!--[if IE 7]>
            <link rel="stylesheet" href="/static/css/font-awesome-ie7.min.css">
            <![endif]-->
            <!--[if lt IE 9]>
            <link rel="stylesheet" href="/static/css/custom-theme/jquery.ui.1.10.2.ie.css">
            <![endif]-->
            <link rel="stylesheet" href="/static/css/docs.css">
            <link rel="stylesheet" href="/static/js/google-code-prettify/prettify.css">

            <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
            <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->

            <!-- Le fav and touch icons -->
            <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/static/ico/apple-touch-icon-144-precomposed.png">
            <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/static/ico/apple-touch-icon-114-precomposed.png">
            <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/static/ico/apple-touch-icon-72-precomposed.png">
            <link rel="apple-touch-icon-precomposed" href="/static/ico/apple-touch-icon-57-precomposed.png">
            <link rel="shortcut icon" href="/static/ico/favicon.png">
<script src="/static/js/jquery-1.9.1.min.js"></script>
<script src="/static/js/jquery-ui-1.10.2.custom.min.js"></script>

        </head>

        <body data-spy="scroll" data-target=".bs-docs-sidebar" data-twttr-rendered="true">

        <!-- Navbar
        ================================================== -->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">

                    
                    <div class="nav-collapse collapse">
                        <ul class="nav">
                                    
                            <?php foreach($categories->result() as $c):?>
                            <li class="active">
                                <a href="<?php echo base_url("list/{$c->id}");?>"><?php echo $c->title;?></a>
                            </li>
                            <?php endforeach;?>
                        </ul>
                        <div id="twitter-share" class="pull-right">
                            <!--a href="https://twitter.com/share" class="twitter-share-button" data-url="http://addyosmani.github.com/jquery-ui-bootstrap/" data-text="A new jQuery UI Bootstrap theme" data-via="addyosmani" data-size="large">Tweet</a-->
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Subhead
        ================================================== -->
        <header class="jumbotron subhead" id="overview">
            <div class="container">
                <h1>jQuery UI Bootstrap</h1>
                
                <p class="lead"><?php echo $this->session->flashdata('flashdata');?></p>
            </div>
        </header>
        <div class="container">
        <!-- Docs nav ================================================== -->
        <div class="row">