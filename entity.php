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
    $types = get_types($dbc, $name);
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
            render_value($dbc, $value);
            echo '<a href="' . $_SERVER['PHP_SELF'] . '?name=' . $name . '&delete_triple_id=' . $id . '"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            echo "</td></tr>";
        }
    }
}

function render_value($dbc, $name) {
    if (strpos($name, PREFIX) === 0) {
        $id = str_replace(PREFIX, "", $name);
        $query = "select * from def where id ='$id'";
        $result = mysqli_query($dbc, $query) or die('Error querying database1.');
        if ($row = mysqli_fetch_array($result)) {
            $name = $row[name];
            $def = $row[def];
            echo '<a href="'.$_SERVER['PHP_SELF'].'?id='.$id.'">'. $name .'</a>&nbsp;<em><small>('. $def .')'.'</small></em>';
        } else {
            echo $name;
        }
    } else {
        echo $name;
    }
}

function get_types($dbc, $name) {
    $query = "select * from graph where subject = '$name' and property = 'a'";
    $types = array();
    $result = mysqli_query($dbc, $query) or die('Error querying database2.');
    while ($row = mysqli_fetch_array($result)) {
        $value = $row[value];
        array_push($types, $value);
    }
    return $types;
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

        <?php
        $width = 300;
        echo '<div class="media">';

        $image_file = 'img/' . $name . '.jpg';
        if (is_file(iconv('utf-8', 'gb2312', $image_file))) {
            //$image_file = 'img/NA.jpg';
            echo '<a class="pull-left" href="search.php?keywords=' . $name . '">';
            echo '<img width="' . $width . '" class="media-object" src="' . $image_file . '" data-src="holder.js/64x64">';
            echo '</a>';
        }


        echo '<div class="media-body"  align ="left">';
        echo '<h2>' . $name . '</h2>';
        echo "<p>&nbsp;<a class=\"btn btn-xs btn-primary\" href=\"individual.php\">查看本体信息</a>";
        echo "&nbsp;<a class=\"btn btn-xs btn-primary\" href=\"editor.php?name=" . $name . "\">添加实体信息</a>";
        echo "&nbsp;<a class=\"btn btn-xs btn-success\" href=\"individual.php\">返回主页</a></p>";

        echo "<table class=\"table\"><tbody>";
        echo "<tr><td width='10%'>代码:</td><td>" . $id . "</td></tr>";

        echo "<tr><td width='10%'>类型:</td><td>" . implode(',', get_types($dbc, $name)) . "</td></tr>";

        echo "<tr><td>定义/注释:</td><td>" . $def;
        render_info_by_property($dbc, $name, '定义');
        render_info_by_property($dbc, $name, '注释');
        echo "</td></tr>";





        echo "</tbody></table>";





        echo '</div></div></div>';


        echo '<div class ="container">';
        render_graph($dbc, $name, $ontology);

        echo '<div class="panel panel-info">';
        echo '<div class="panel-heading">';
        echo '<h3 class="panel-title">' . 详细信息 . '</h3>';
        echo '</div>';
        echo '<div class="panel-body">';

        echo "<table class=\"table\"><tbody>";
        render_details($dbc, PREFIX . $id);
        render_details($dbc, $name);
        echo "</tbody></table></div></div>";
        ?>


    </div>

    </div>
    <?php
}
include_once ("./foot.php");
?>
