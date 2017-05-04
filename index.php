<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <script src="Scripts.js" type="text/javascript"></script>
        <link href="Style.css" rel="stylesheet" type="text/css"/>
        <title>World's Greatest Movie List</title>
    </head>
    <body>
        <header>
            <h1>World's Greatest Movie List</h1>
        </header>
        
        <nav>
            <?php
            include_once 'Movies.php';
            ?>
        </nav>
        
        <div>
            <?php
            include_once 'People.php';
            ?>
        </div>
        
        <section style="sect">
            <?php
            include_once 'MovieInfo.php';
            ?>
        </section>
    </body>
</html>
