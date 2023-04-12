<?php
include_once "classes/Page.php";
include_once "classes/Db.php";
include_once "classes/Filter.php";
Page::display_header("Messages");
$db = new Db("localhost", "root", "", "news");
// adding new message
if (isset($_REQUEST['add_message'])) {
    $filter = new Filter();
    $name = $filter->purify($_REQUEST['name']);
    $type = $filter->filterSqlInjection($_REQUEST['type']);
    $content = $filter->purify($_REQUEST['content']);
    if (!$db->addMessage($name,$type,$content))
        echo "Adding new message failed";
}
?>

<!---------------------------------------------------------------------->
<hr>
<P> Messages</P>
<ol>
 <?php
 $where_clause="";
 // filtering messages
 if (isset($_REQUEST['filter_messages'])) {
 $string = $_REQUEST['string'];
 $where_clause= " WHERE message LIKE '%" . $string . "%'";
 }
 if (isset($_REQUEST['edit_message'])) {
    $filter = new Filter();
    $id = $filter->filterSqlInjection($_REQUEST['id']);
    $content = $filter->purify($_REQUEST['content']);
    if (!$db->editMessage($id, $content))
        echo "Editing message failed";
}
 $sql = "SELECT * from message" . $where_clause;
 echo $sql;
 echo "<BR/><BR/>";
 $messages = $db->select($sql);
 foreach ($messages as $msg)://returned as objects
 echo "<li>";
 echo $msg->message ;
 echo "</li>";
 echo " <a href='messages_edit.php?id=".$msg->id."'><input type='submit' value='Edit message' name='edit_message'></a>";
 endforeach;
 ?>
</ol>
<!---------------------------------------------------------------------->
<hr>
<P>Messages filtering</P>
<form method="post" action="messages.php">
 <table>
 <tr>
 <td>Title contains: </td>
 <td>
 <label for="name"></label>
 <input required type="text" name="string" id="string" size="80"/>
 </td>
 </tr>
 </table>
 <input type="submit" id= "submit"
value="Find messages" name="filter_messages">
</form>

<!---------------------------------------------------------------------->
<hr>
<P>Navigation</P>
<?php
Page::display_navigation();
?>
 </body