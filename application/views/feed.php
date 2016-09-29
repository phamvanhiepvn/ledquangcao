<?php
echo '<?xml version="1.0" encoding="utf-8"?>' . "n";
?>
<rss version="2.0"
     xmlns:dc="http://purl.org/dc/elements/1.1/"
     xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
     xmlns:admin="http://webns.net/mvcb/"
     xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
     xmlns:content="http://purl.org/rss/1.0/modules/content/">
    <channel>
        <title><?php echo $feed_name; ?></title>
        <link>
        <?php echo $feed_url; ?>
        </link>
        <description><?php echo $page_description; ?></description>
        <dc:language><?php echo $page_language; ?></dc:language>
        <dc:creator><?php echo $creator_email; ?></dc:creator>
        <dc:rights>Copyright <?php echo gmdate("Y", time()); ?>
        </dc:rights>
        <admin:generatorAgent rdf:resource="<?php echo  base_url() ?>"/>

        <?php if (isset($news) && is_array($news)) {
            foreach ($news as $row) {
                ?>
                <item>
                    <title><?php echo $row->title; ?></title>
                    <link><?php echo base_url('tin/' . $row->alias); ?></link>
                    <description>
                        <![CDATA[
                        <?php
                        if ($row->description) {
                            echo character_limiter(@$row->description, 200);
                        } else {
                            echo character_limiter(@$row->content, 200);
                        }
                        ?>
                        ]]>
                    </description>
                    <pubDate><?php echo date('c', @$row->time); ?></pubDate>
                </item>
            <?php
            }
        }?>

        <?php if (isset($products) && is_array($products)) {
            foreach ($products as $product) {
                ?>
                <item>
                    <title><?php echo $product->name; ?></title>
                    <link><?php echo base_url('san-pham/' . $product->alias); ?></link>
                    <description>
                        <![CDATA[
                        <?php
                        if ($product->description) {
                            echo character_limiter(@$product->description, 200);
                        } else {
                            echo character_limiter(@$product->detail, 200);
                        }
                        ?>
                        ]]>
                    </description>
                    <pubDate><?php echo date('c', @$product->time); ?></pubDate>
                </item>
            <?php
            }
        }?>

    </channel>
</rss>