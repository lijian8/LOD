<?php
include_once ("./header.php");
include_once ("./onto_array.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");

$dbc = mysqli_connect('localhost', 'root', 'yutong', 'exp') or die('Error connecting to MySQL server.');


$schema = array(
    '中药' => array(
        array(
            "property" => "***包含的化学成分",
            "table" => "yanjyw",
            "subject" => "yaowumc",
            "object" => "huaxuecf",
            "db" => "药理库"
        ),
        array(
            "property" => "***药理作用",
            "table" => "yanjyw",
            "subject" => "yaowumc",
            "object" => "yaolifl",
            "db" => "药理库"
        ),
        array(
            "property" => "***相关化学实验",
            "table" => "huaxuesy",
            "subject" => "shiydx",
            "object" => array("title" => "题目", "author" => "作者", "unit" => "unit", "year" => "年份"),
            "db" => "化学库"
        )
    ),
    '化学成分' => array(
        array(
            "property" => "***包含的化学成分",
            "table" => "yanjyw",
            "subject" => "yaowumc",
            "object" => "huaxuecf"
        ),
        array(
            "property" => "***药理作用",
            "table" => "yanjyw",
            "subject" => "yaowumc",
            "object" => "yaolifl"
        )
    )
);

if ((!isset($_GET['name'])) || (!isset($_GET['type']))) {

    include_once("./exp_examples.php");
} else {
    $entity_name = $_GET['name'];
    $entity_type = $_GET['type'];
    ?>

    <div class ="container">
        <h1><?php echo $entity_name . "（" . $entity_type . "）"; ?></h1>
        <hr>
        <?php
        foreach ($schema['中药'] as $mapping) {
            $property = $mapping["property"];
            $table = $mapping["table"];
            $subject = $mapping["subject"];
            $object = $mapping["object"];
            if (is_string($object)) {

                $query = "SELECT $object FROM $table WHERE $subject = '$entity_name' and $object is not null";
                $result = mysqli_query($dbc, $query) or die('Error querying database1.');
                if (mysqli_num_rows($result) > 0) {
                    ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo $property; ?></h3>
                        </div>

                        <ul class="list-group">
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                echo '<li class="list-group-item">' . $row[0] . '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <?php
                }
            }elseif (is_array($object)){
                foreach ($object as $obj){
                    
                }
            }
        }
        ?>
    </div>

    <?php
}
include_once ("./foot.php");
?>