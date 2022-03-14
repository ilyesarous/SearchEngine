<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="indx1.css">
    <link rel="shortcut icon" href="S.png" type="image/x-icon">
    <title>Search Engine</title>
</head>
<body>
    <form action="index.php" method="get" class="container">
        <img src="S.png" alt="logo" id="logo" width="100">
        <div class="a">
            <input type="text" placeholder="search" name="search" value="<?php echo($_GET['search'])?>" id="search">
            <input type="submit" value="search" id="searchBtn">
        </div>
    </form>
    <hr />
    <div class="php">
        <?php
            $search = $_GET['search'];

            $terms = explode(" ",$search);
            $query  ="";

            $query .= "SELECT * FROM search WHERE ";
            $i = 0 ;
            foreach($terms as $each){
            $i++;
            if ($i == 1) {
                    $query .= "keywords LIKE'%$each%' ";
                }else
                    $query .= "OR keywords LIKE'%$each%' ";
            }
            //connect
            mysql_connect("localhost", "root","root");
            mysql_select_db("serchengine");

            $id = "";
            $title = "";
            $description = "";
            $link = "";

            $query = mysql_query($query);
            $numrows = mysql_num_rows($query);
            if ($numrows > 0) {
                while ($row = mysql_fetch_assoc($query)) { //fetch assoc function bch taaml array w taatini chthama fl db
                    $id = $row['idSearch'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $link = $row['link'];

                    echo"<h2><a href='$link'> $title </a></h2>
                    <p id='desc'>$description</p><br />";
                }
            }
            else
                echo "No results found for \"<b>$search</b>\"";

            //disconnect
            mysql_close();
        ?>
    </div>
</body>
</html>