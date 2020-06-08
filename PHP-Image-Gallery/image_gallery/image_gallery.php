<!DOCTYPE html>
<html>
<!-- 
Create a web app which would allow you to upload images from your
computer and would make a nice image gallery with thumbnails
of these pictures.
-->
    <head>
        <title>Simple Image Gallery</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="image_gallery.css">

    </head>
    <body>
        <?php //echo "\nGET: "; print_r($_GET);  ?>
        <?php //echo "\nPOST: "; print_r($_POST);  ?>
        <?php //echo "\nFILES: "; print_r($_FILES);  ?>

        <?php 
            foreach($_POST as $key => $value)
            {
                if (strstr($key, 'delete'))
                {
                    // Make sure the key has the delete word in it,
                    // and then split across the colon
                    $exploded = explode(":", $key);

                    // Find the last underscore in the filename
                    $last_und = strripos ($exploded[1], "_");

                    // then replaced the _ in the filename with the dot
                    $replaced = substr($exploded[1], 0, $last_und) . ".";
                    $replaced .= substr($exploded[1], $last_und + 1);

                    // Remove the file
                    unlink("./images/" . $replaced);

                    // Show the updated gallery
                    header("Location: image_gallery.php");
                }
            }
        ?>

        <form class="upload_form" action="upload.php" method="post" enctype="multipart/form-data">
            <div>
                <label for="fileToUpload">Select image to upload:</label>
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input class="btn btn-primary" type="submit" value="Upload Image" name="submit">
            </div>
        </form>

        <div class="container">
        <?php
            $dir = new DirectoryIterator(dirname("./images/*"));
            foreach ($dir as $fileinfo) {
                if (!$fileinfo->isDot()) {
                    echo "<div class='thumbnail'>";
                    echo "<a href='" . $fileinfo->getPathname() . "'>";
                    echo "  <img class='img-thumbnail img-fluid' alt='" . $fileinfo->getFilename() . "' src='" . $fileinfo->getPathname() . "' />"; 
                    echo "  <div class='caption'>" . $fileinfo->getFilename() . "</div>";
                    echo "</a>";
                    echo "<form action='image_gallery.php' method='post'>";
                    echo "<button value='delete' type='submit' id='delete' name='delete:" . $fileinfo->getFilename() . "'>Delete</button>";
                    echo "</form>";
                    echo "</div>";
                }
            }        
        ?>
        </div>

    </body>
</html>
