<?PHP require('setup.php'); ?>
<?PHP 
$result = mysql_query("SELECT nl.*, 
                              notes.htmlText AS note, notes.name AS noteName, notes.html_id AS note_id,
                              htmlVer.htmlText AS htmlVersion, htmlVer.name AS htmlVName, htmlVer.html_id AS htmlVer_id
                       FROM NewsLetters nl 
                           LEFT JOIN html notes ON nl.htmlNote_id = notes.html_id
                           LEFT JOIN html htmlVer ON nl.html_id = htmlVer.html_id
                       WHERE newslettercat_id = 1
                       ORDER BY nl.publishDate DESC");
    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }
?>
<page name="newsletters">
    <?PHP
    $row = mysql_fetch_assoc($result);
    echo '<letters category="' . $row['newslettercat_id'] . '">';
    mysql_data_seek( $result, 0);
    while ($row = mysql_fetch_assoc($result)) {
        echo '<letter id="' . $row['newsletter_id'] . '" name="'.  $row['letterName']  .'">';
            echo '<note name="' . $row['noteName'] .'"><![CDATA[' . $row['note'] . ']]></note>';
            echo '<htmlVersion name="' . $row['htmlVName'] . '"><![CDATA[' . $row['htmlVersion'] . ']]></htmlVersion>';
            echo '<fileName>' . $row['fileName'] . '</fileName>';
            echo '<filePath>' . $row['filePath'] . '</filePath>';
            echo '<publishDate>' . $row['publishDate'] . '</publishDate>';
        echo '</letter>';
    }
    ?>
    </letters>
</page>

<?PHP
    // Free the resources associated with the result set
    // This is done automatically at the end of the script
    mysql_free_result($result);
?>
