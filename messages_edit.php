<?php
include_once "classes/Page.php";
include_once "classes/Db.php";
Page::display_header("Edit message");
?>
<hr>
<P> Edit message</P>
<form method="post" action="messages.php">
    <input name="id" id="id" value=<?php echo htmlspecialchars($_GET["id"])?>>
    <table>
        <tr>
            <td>Message content</td>
            
            <td>
                <label for="content"></label>
                <textarea required type="text" name="content" id="content" rows="10" cols="40"></textarea>   
            </td>
        </tr>
    </table>
    <a href='messages.php'><input type="submit" id= "submit" value="Edit message" name="edit_message"></a>
</form>
<hr>
<P>Navigation</P>
<?php
Page::display_navigation();
?>
</body>
</html>