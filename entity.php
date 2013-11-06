<?php
include_once ("./header.php");
include_once ("./onto_array.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./db_helper.php");

$names = array('英文正名', '英文异名', '中文异名', '中文正名', '异名', '汉语拼音', '英文名', '别名');
$type_labels = array('类型');

if (isset($_GET['delete_triple_id'])) {
    $query = "DELETE FROM graph WHERE id = '" . $_GET['delete_triple_id'] . "'";
    mysqli_query($dbc, $query) or die('Error querying database.');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "select name, def from def where id ='$id'";
    $result = mysqli_query($dbc, $query) or die('Error querying database1.');
    if ($row = mysqli_fetch_array($result)) {
        $name = $row[name];
        $def = $row[def];
    } else {
        //render_warning('无相关实体信息！');
    }
} else if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $query = "select id, def from def where name ='$name'";
    $result = mysqli_query($dbc, $query) or die('Error querying database1.');
    if ($row = mysqli_fetch_array($result)) {
        $id = $row[id];
        $def = $row[def];
    } else {
      //  render_warning('无相关实体信息！');
    }
} else {
    //render_warning('无相关实体信息！');
}
?>


<div class="container">
    <ul class="nav nav-pills pull-right">    
        <li ><a  href="editor.php?name=<?php echo $name; ?>"><span class="glyphicon glyphicon-plus"></span>&nbsp;添加信息</a></li>
        <li ><a  href="editor.php?name=<?php echo $name; ?>"><span class="glyphicon glyphicon-home"></span>&nbsp;返回首页</a></li>
    </ul>


<?php
echo '<ul class="nav nav-pills">';
echo '<li ><a  href="synthesis_lit_graph.php?name='. $name. '">综合知识</a></li>';
foreach ($db_labels as $db => $db_label) {
    echo '<li ' . (($db == $db_name) ? 'class="disabled"' : '') . '><a href="' . $_SERVER['PHP_SELF'] . "?name=$name&db_name=" . $db . '">' . $db_label . '</a></li>';
}
echo '<li><a href="#">更多>></a></li>';
echo '</ul>';
?>


    <h1>  
        <font face="微软雅黑"><strong>
<?php echo $name . '(' . implode(',', get_types($dbc, $id)) . ')'; ?>       
        </strong>
        </font>
    </h1>

<?php
if (isset($name) && $name != '' && isset($id) && $id != '') {
    echo $def;

    if ($db_name == 'tcmls')
        include_once ("./entity_detail.php");
    if ($db_name == 'tcmct')
        include_once ("./entity_lit_graph.php");
    if ($db_name == 'formula')
        include_once ("./entity_summary.php");
    if ($db_name == 'herb')
        include_once ("./entity_simple_lit_graph.php");
    if ($db_name == 'formula_dic')
        include_once ("./entity_detail.php");
    if ($db_name == 'spleen')
        include_once ("./entity_detail.php");
    if ($db_name == 'cases')
        include_once ("./entity_detail.php");
}else{
    render_warning('该库中无相关实体信息！');
}
include_once ("./foot.php");
?>
