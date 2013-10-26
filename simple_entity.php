<?php
include_once ("./header.php");
include_once ("./onto_array.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./db_helper.php");
/*
  function render_graph($dbc, $name) {
  $query = "select * from graph where subject ='$name'  limit 100";

  $result = mysqli_query($dbc, $query) or die('Error querying database2.');
  while ($row = mysqli_fetch_array($result)) {
  $property = $row[property];
  $value = $row[value];

  $id = $row[id];
  echo "<p><strong>$property</strong>:&nbsp;$value";

  echo '<a href="' . $_SERVER['PHP_SELF'] . '?name=' . $name . '&delete_triple_id=' . $id . '"><span class="glyphicon glyphicon-remove-circle"></span></a>';

  echo "</p>";
  }
  } */

function render_info_by_property($dbc, $name, $property) {
    $query = "select * from graph where subject ='$name' and property = '$property'  limit 100";

    $result = mysqli_query($dbc, $query) or die('Error querying database2.');
    while ($row = mysqli_fetch_array($result)) {

        $value = $row[value];
        $id = $row[id];
        echo "<p>$value";
        echo '<a href="' . $_SERVER['PHP_SELF'] . '?name=' . $name . '&delete_triple_id=' . $id . '"><span class="glyphicon glyphicon-remove-circle"></span></a>';
        echo "</p>";
    }
}

function render_graph_by_property($dbc, $name, $property) {
    $query = "select * from graph where subject ='$name' and property='$property' limit 100";
    
    $result = mysqli_query($dbc, $query) or die('Error querying database2.');

    if (mysqli_num_rows($result) != 0) {
        echo '<div class="panel panel-info">';
        echo '<div class="panel-heading">';
        echo '<h3 class="panel-title">' . $property . '</h3>';
        echo '</div>';
        echo '<div class="panel-body">';
        while ($row = mysqli_fetch_array($result)) {
            //$property = $row[property];
            $value = $row[value];
            $id = $row[id];
            //echo "<p><strong>$property</strong>:&nbsp;$value";
            echo $value;

            echo '<a href="' . $_SERVER['PHP_SELF'] . '?name=' . $name . '&delete_triple_id=' . $id . '"><span class="glyphicon glyphicon-remove-circle"></span></a>';

            echo "</p>";
        }
        echo '</div></div>';
    }
}

function render_graph($dbc, $name, $ontology) {
    //$types = get_types($dbc, $name);
    $types = array('方剂');
    foreach ($types as $type) {
        $properties = $ontology[$type];
        foreach ($properties as $property) {
            render_graph_by_property($dbc, $name, $property);
        }
    }
}

function render_details($dbc, $name) {
    $query = "select * from graph where subject ='$name'  limit 100";

    $result = mysqli_query($dbc, $query) or die('Error querying database2.');

    if (mysqli_num_rows($result) != 0) {
        while ($row = mysqli_fetch_array($result)) {
            $property = $row[property];
            $value = $row[value];
            $id = $row[id];
            //echo "<p><strong>$property</strong>:&nbsp;$value";
            echo "<tr><td width='10%'>" . $property . ":</td><td>";
            echo render_value($dbc, $value);
            echo '<a href="' . $_SERVER['PHP_SELF'] . '?name=' . $name . '&delete_triple_id=' . $id . '"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            echo "</td></tr>";
        }
    }
}

function get_types($dbc, $name, $id) {

    $types = get_values($dbc, $name, '类型');
    return array_merge($types, get_values($dbc, PREFIX . $id, '类型'));
}

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
        render_warning('无相关实体信息！');
    }
} else if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $query = "select id, def from def where name ='$name'";
    $result = mysqli_query($dbc, $query) or die('Error querying database1.');
    if ($row = mysqli_fetch_array($result)) {
        $id = $row[id];
        $def = $row[def];
    } else {
        render_warning('无相关实体信息！');
    }
} else {
    render_warning('无相关实体信息！');
}

if (isset($name) && $name != '' && isset($id) && $id != '') {
    ?>


    <div class="container">
        <ul class="nav nav-pills pull-right">    
            <li ><a  href="editor.php?name=<?php echo $name; ?>"><span class="glyphicon glyphicon-plus"></span>&nbsp;添加信息</a></li>
            <li ><a  href="editor.php?name=<?php echo $name; ?>"><span class="glyphicon glyphicon-home"></span>&nbsp;返回首页</a></li>
        </ul>


        <?php
        echo '<ul class="nav nav-pills">';
        echo '<li ><a  href="editor.php?name=<?php echo $name; ?>">领域本体</a></li>';

        foreach ($db_labels as $db => $db_label) {
            echo '<li ' . (($db == $db_name) ? 'class="disabled"' : '') . '><a href="' . $_SERVER['PHP_SELF'] . "?name=$name&db_name=" . $db . '">' . $db_label . '</a></li>';
        }
        echo '<li><a href="#">更多>></a></li>';
        echo '</ul>';
        ?>


        <h1>  
            <?php echo $name . '(' . implode(',', get_types($dbc, $name, $id)) . ')'; ?>       
        </h1>

        <hr>
    
        <p/>
        <div class ="container">
            <?php
            
          
            render_graph($dbc, $name, $ontology);
          
            ?>
           
        </div>



        <?php
    }
    include_once ("./foot.php");
    ?>
