<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="UTF-8">
        <link href="css/bookLister.css" rel="stylesheet" type="text/css"/>
        <title>Book Lister</title>
    </head>
    <body>
        <div id="container">
            <?php

            require 'dbConnect.php';

            if(isset($_GET['clicked'])){
            ?>
            <form action="<?=$_SERVER[PHP_SELF]?>" method="post">
                <label id="bookArea" for="newBookTitle">Enter the book's title</label>
                <br><br>
                <textarea name="newBookTitle" id="newBookTitle" rows="10" cols="40">Enter book title</textarea>
                <br><br>
                <label id="bookAuthor" for="newAuthor">Enter the author of this book</label>
                <input type="text" name="newAuthor" id="newAuthor">
                <br><br>
                <label id="genre" for="bookCategory">Choose Book Genre</label>
                <select name="bookCategory" id="bookCategory">
                    <?php
                    require 'dbConnect.php';
                    $closeSelect = true;
                    //run query to select the book genres from the database
                    try{
                        //create sql command
                        $sql = "SELECT * FROM categories";

                        //execute query and store the returned result set
                        $categoryResults = $pdo->query($sql);

                    } catch (Exception $ex) {

                        $error = "Could not select categories: " . $ex->getMessage();
                        include 'error.html.php';
                        exit();

                    }

                    // step through the result set, printing out an <option> tag for each indivvidual result
                    while ($row = $categoryResults->fetch()) {

                        echo "\t\t<option value=\"$row[id]\">$row[name]</option>\n";

                    }
                    $closeSelect = false;
                    ?>

                </select>
                <br><br>
                <input type="submit" name="addBook" value="Add Book">
            </form>
            <?php
            } else {

                echo "<a href=\"$_SERVER[PHP_SELF]?clicked=1\">Add Book</a>";

            }

            ?>
        </div>
    </body>
</html>
