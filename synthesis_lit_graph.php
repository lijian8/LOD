<?php
include_once ("./header.php");
include_once ("./onto_array.php");
include_once ("./appvars.php");
//include_once ("./entity_helper.php");

include_once ("./db_helper.php");

function get_types($dbc, $id) {
    return get_values($dbc, PREFIX . $id, '类型');
}

function get_values($dbc, $subject, $property) {
    $query = "select * from graph where subject='$subject' and property = '$property'";

    $result = mysqli_query($dbc, $query) or die('Error querying database:' . $query);
    $types = array();
    while ($row = mysqli_fetch_array($result)) {
        $value = $row[value];
        array_push($types, $value);
    }

    return $types;
}

function get_entity_link($id, $name) {
    return "<a href=\"" . $_SERVER[PHP_SELF] . "?id=$id\">$name</a>";
}

function get_summary($dbc, $db_name, $db_label, $name) {
    $s = '';
    $query = "select * from graph where subject ='$name' limit 20";
    $result = mysqli_query($dbc, $query) or die('Error querying database:' . $query);
    if (mysqli_num_rows($result) != 0) {
        $r = get_property_values_from_row($dbc, $db_name, $db_label, $result, array(), false);
        foreach ($r as $property => $value) {
            $s .= "$property:&nbsp;";
            $s .= implode(',', $value);
            $s .= "&nbsp;";
        }
    }

    return $s;
}

function render_value($dbc, $db_name, $db_label, $name, $with_def = true) {

    if (strpos($name, $db_name . ':o') === 0) {
        $id = str_replace($db_name . ':o', "", $name);
        $query = "select * from def where id ='$id'";
        $result = mysqli_query($dbc, $query) or die('Error querying database:' . $query);
        if ($row = mysqli_fetch_array($result)) {
            $name = $row[name];
            $def = $row[def];
            $result = get_entity_link($id, $name);
            if ($with_def) {
                if ($def == '')
                    $def = get_summary($dbc, $db_name, $db_label, $db_name . ':o' . $id);
                if ($def != '') {
                    $result .= '&nbsp;<em><small>(' . $def . ')' . '</small></em>';
                }
            }
        } else {
            $result = $name;
        }
    } else {
        $result = $name;
    }
   if ($with_def) {


        $result .= '&nbsp;(来源：<a href="db_profile.php?db_name=' . $db_name . '">' . $db_label . '</a>)';
   }

    return $result;
}

function get_reverse_property_values_from_row($dbc, $db_name, $db_label, $result, $values, $with_def = true) {
    while ($row = mysqli_fetch_array($result)) {
        $property = $row[property] . '之逆属性';
        $value = $row[subject];
        $value = render_value($dbc, $db_name, $db_label, $value, $with_def);
        if (array_key_exists($property, $values)) {
            array_push($values[$property], $value);
        } else {
            $values[$property] = array($value);
        }
    }
    return $values;
}

function get_property_values_from_row($dbc, $db_name, $db_label, $result, $values, $with_def = true) {
    while ($row = mysqli_fetch_array($result)) {
        $property = $row[property];
        $value = $row[value];

        $value = render_value($dbc, $db_name, $db_label, $value, $with_def);

        if (array_key_exists($property, $values)) {
            array_push($values[$property], $value);
        } else {
            $values[$property] = array($value);
        }
    }
    return $values;
}

function get_property_values($dbc, $db_name, $db_label, $name, $values = array()) {

    $query = "select * from graph where subject ='$name'";
    $result = mysqli_query($dbc, $query) or die('Error querying database:' . $query);
    if (mysqli_num_rows($result) != 0) {
        $values = get_property_values_from_row($dbc, $db_name, $db_label, $result, $values);
        /**
        if (mysqli_num_rows($result) < 10) {
            
        } else {
            $values = get_property_values_from_row($dbc, $db_name, $db_label, $result, $values, false);
        }*/
    }

    return $values;
}

function get_reverse_property_values($dbc, $db_name, $db_label, $name, $values = array()) {

    $query = "select * from graph where value ='$name'";
    $result = mysqli_query($dbc, $query) or die('Error querying database:' . $query);

    if (mysqli_num_rows($result) != 0) {
        $values = get_reverse_property_values_from_row($dbc, $db_name, $db_label, $result, $values);
        /**
        if (mysqli_num_rows($result) < 10) {
            $values = get_reverse_property_values_from_row($dbc, $db_name, $db_label, $result, $values);
        } else {
            $values = get_reverse_property_values_from_row($dbc, $db_name, $db_label, $result, $values, false);
        }*/
    }

    return $values;
}

$names = array('英文正名', '英文异名', '中文异名', '中文正名', '异名', '汉语拼音', '英文名', '别名');
$type_labels = array('类型');

if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $query = "select id, def from def where name ='$name'";
    $result = mysqli_query($dbc, $query) or die('Error querying database:' . $query);
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
    echo '<li ><a  href="synthesis_lit_graph.php?name=' . $name . '">综合知识</a></li>';

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
    if (isset($name) && $name != '') {
        $values = array();
        $db_labels = array( "tcmls" => "TCMLS", "tcmct" => "TCMCT", "clan" => "古籍语言", "spleen" => "证候库");


        foreach ($db_labels as $db_name => $db_label) {

            $db = $dbs["$db_name"];
            $dbc = mysqli_connect($db[0], $db[1], $db[2], $db[3]) or die('Error connecting to MySQL server.');


            $query = "select id from def where name ='$name'";

            $result = mysqli_query($dbc, $query) or die('Error querying database:' . $query);

            while ($row = mysqli_fetch_array($result)) {

                $values = get_property_values($dbc, $db_name, $db_label, $db_name . ':o' . $row[id], $values);

                $values = get_reverse_property_values($dbc, $db_name, $db_label, $db_name . ':o' . $row[id], $values);
            }
        }



        echo '<hr>';
        //include("pv_panel.php");
        
        foreach ($values as $property => $value) {
            ?>

            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $property; ?></h3>
                </div>

                <ul class="list-group">
                    <?php
                    foreach ($value as $v) {
                        echo '<li class="list-group-item">' . $v . '</li>';
                    }
                    ?>
                </ul>
            </div>
            <?php
        }
    } else {
        render_warning('该库中无相关实体信息！');
    }
    include_once ("./foot.php");
    ?>





