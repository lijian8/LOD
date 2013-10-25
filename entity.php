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
            echo '<a href="' . $_SERVER['PHP_SELF'] . '?id=' . $id . '">' . $name . '</a>&nbsp;<em><small>(' . $def . ')' . '</small></em>';
        } else {
            echo $name;
        }
    } else {
        echo $name;
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
        $width = 300;
        echo '<ul class="nav nav-pills">';
        echo '<li ><a  href="editor.php?name=<?php echo $name; ?>">领域本体</a></li>';

        foreach ($db_labels as $db => $db_label) {
            echo '<li ' . (($db == $db_name) ? 'class="disabled"' : '') . '><a href="' . $_SERVER['PHP_SELF'] . "?name=$name&db_name=" . $db . '">' . $db_label . '</a></li>';
        }
        echo '<li><a href="#">更多>></a></li>';
        echo '</ul>';
        ?>

        <?php
        echo '<h1>' . $name . '(' . implode(',', get_types($dbc, $name, $id)) . ')</h1>';

        echo '<div class="media">';

        $image_file = 'img/' . $name . '.jpg';
        if (is_file(iconv('utf-8', 'gb2312', $image_file))) {
            //$image_file = 'img/NA.jpg';
            echo '<a class="pull-right" href="search.php?keywords=' . $name . '">';
            echo '<img width="' . $width . '" class="media-object" src="' . $image_file . '" data-src="holder.js/64x64">';
            echo '</a>';
        }


        echo '<div class="media-body"  align ="left">';
        echo $def;
        render_info_by_property($dbc, $name, '定义');
        render_info_by_property($dbc, $name, '注释');
        echo "<table class=\"table\"><tbody>";
        //echo "<tr><td width='10%'>代码:</td><td>" . $id . "</td></tr>";


        echo "<tr><td width='10%'>英文名:</td><td>";

        render_info_by_property($dbc, PREFIX . $id, '英文正名');
        render_info_by_property($dbc, $name, '英文正名');
        render_info_by_property($dbc, PREFIX . $id, '英文异名');
        render_info_by_property($dbc, $name, '英文异名');
        echo "</td></tr>";

        echo "<tr><td width='10%'>异名:</td><td>";

        render_info_by_property($dbc, PREFIX . $id, '中文异名');
        render_info_by_property($dbc, $name, '中文异名');
        render_info_by_property($dbc, PREFIX . $id, '英文异名');
        render_info_by_property($dbc, $name, '英文异名');
        render_info_by_property($dbc, PREFIX . $id, '异名');
        render_info_by_property($dbc, $name, '异名');
        echo "</td></tr>";

        // echo "<tr><td width='10%'>类型:</td><td>" . implode(',', get_types($dbc, $name, $id)) . "</td></tr>";







        echo "</tbody></table>";





        echo '</div></div></div>';
        echo "<p/>";


        echo '<div class ="container">';
        if (isset($id) && $id != '') {
            render_graph($dbc, PREFIX . $id, $ontology);
        } else {
            render_graph($dbc, $name, $ontology);
        }


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
