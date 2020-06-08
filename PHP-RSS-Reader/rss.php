<!DOCTYPE html>
<html>
<!-- 
    Build an app which would get you the latest headlines from RSS of 
    your favourite blog.
-->
    <head>
        <title>RSS Headlines</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="rss.css">
        
    </head>
    <body>
        <?php //echo "\nGET: "; print_r($_GET);  ?>
        <?php //echo "\nPOST: "; print_r($_POST);  ?>
        <?php //echo "\nFILES: "; print_r($_FILES);  ?>

        <?php
            function selected($method, $key, $value) {
                if (isset($method[$key])) {
                    if ($method[$key] == $value) {
                        return "SELECTED";
                    } else {
                        return "";
                    }
                } else {
                    return '';
                }
            }
        ?>

        <form method="post" action="rss.php">
            <label id="which_feed_label" for="which_feed">Select an RSS-feed:</label>
            <select id="which_feed" name="which_feed">
                <option disabled>Select an RSS Feed:</option>                          
                <option value="craigslist" <?php echo selected($_POST, "which_feed", "craigslist"); ?>>Best Of Craigslist</option>
                <option value="hnrss_jobs" <?php echo selected($_POST, "which_feed", "hnrss_jobs"); ?>>Hacker News Jobs</option>
                <option value="joe_rogan_podcast" <?php echo selected($_POST, "which_feed", "joe_rogan_podcast"); ?>>Joe Rogan Podcast</option>
                <option value="bill_maher_feed" <?php echo selected($_POST, "which_feed", "bill_maher_feed"); ?>>Bill Maher Feed</option>
                <option value="diane_rehm_show" <?php echo selected($_POST, "which_feed", "diane_rehm_show"); ?>>Diane Rehm Show</option>
                 <option value="russell_brand_podcast" <?php echo selected($_POST, "which_feed", "russell_brand_podcast"); ?>>Russell Brand Podcast</option>
            </select>
            <button value="Clear RSS" id="clear_rss">Clear RSS Content</button>
            <input type="submit" value="Get RSS Feed" />
        </form>

        <?php 
            $mapping['craigslist'] = "https://www.craigslist.org/about/best/all/index.rss";
            $mapping['hnrss_jobs'] = "https://hnrss.org/jobs";
            $mapping['joe_rogan_podcast'] = "http://podcasts.joerogan.net/feed";
            $mapping['bill_maher_feed'] = "http://billmaher.hbo.libsynpro.com/rss";
            $mapping['diane_rehm_show'] = "https://dianerehm.org/rss/npr/dr_podcast.xml";
            $mapping['russell_brand_podcast'] = "https://rss.art19.com/under-the-skin";

            if (isset($_POST['which_feed'])) {

                $xml = $mapping[$_POST['which_feed']];

                $xmlDoc = new DOMDocument();
                $xmlDoc->load($xml);

                echo "<div id='rss_content'>";

                // get elements from "<channel>"
                $channel = $xmlDoc->getElementsByTagName('channel')->item(0);

                $channel_title = '';

                if (! is_null($channel)) {
                    $channel_title = $channel->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
                }
                
                $channel_link = '#';
                
                if (! is_null($channel)) {
                    if (! is_null($channel->getElementsByTagName('link')->item(0)->childNodes->item(0))) {
                        $channel_link = $channel->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
                    }
                }

                $channel_desc = '';
                
                if (! is_null($channel)) {
                    if (! is_null($channel->getElementsByTagName('description')->item(0)->childNodes->item(0))) {
                        $channel_desc = $channel->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;
                    }
                }

                // output elements from "<channel>"
                echo("<p><a href='" . $channel_link . "'>" . $channel_title . "</a>");
                echo("<br>");
                echo($channel_desc . "</p>");

                // get and output "<item>" elements
                $x = $xmlDoc->getElementsByTagName('item');
                for ($i = 0; $i <= 5; $i++) {
                    
                    echo "<div class='channelItem'>";

                    if (! is_null($x->item($i))) {
                        $item_title = $x->item($i)->getElementsByTagName('title')->item(0)->childNodes->item(0)->nodeValue;
                        
                        $item_link = '#';
    
                        if (! is_null($x->item($i)->getElementsByTagName('link')->item(0))) {
                            if (! is_null($x->item($i)->getElementsByTagName('link')->item(0)->childNodes)) {
                                $item_link = $x->item($i)->getElementsByTagName('link')->item(0)->childNodes->item(0)->nodeValue;
                            }
                        }    
    
                        $item_desc = $x->item($i)->getElementsByTagName('description')->item(0)->childNodes->item(0)->nodeValue;
                        
                        echo ("<p><a href='" . $item_link . "'>" . $item_title . "</a>");
                        echo ("<br>");
                        echo ($item_desc . "</p>");
    
                    }

                    echo "</div>";

                } 
                echo "</div>";
            }
        ?>

        <script>

            document.getElementById('clear_rss').addEventListener("click", function(evt) {
                document.getElementById('rss_content').innerHTML = '';
                evt.preventDefault();
            });

        </script>

    </body>
</html>
