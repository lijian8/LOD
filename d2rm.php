<?php
/*
include_once ("./header.php");
include_once ("./onto_array.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./db_helper.php");
*/

function is_legal($value) {
    return isset($value) && $value != '' && $value != 'null' && $value != 'NULL';
}

//$dbc = mysqli_connect('localhost', 'root', 'yutong', 'exp') or die('Error connecting to MySQL server.');
//echo $db_name;
//echo $entity_type;

$schema = array(
    "药理作用" => array(
        array(
            "property" => "具***作用的单味药",
            "object_type" => "中药",
            "table" => "yanjyw",
            "where_clause" => " yaowulx='单味药'",
            "subject" => "yaolifl",
            "object" => "yaowumc",
            "db" => "中药药理实验数据库"
        ),
        array(
            "property" => "具***作用的化学成分",
            "object_type" => "中药化学成分",
            "table" => "yanjyw",
            "where_clause" => " yaowulx='化学成分'",
            "subject" => "yaolifl",
            "object" => "yaowumc",
            "db" => "中药药理实验数据库"
        ),
        array(
            "property" => "具***作用的方剂",
            "object_type" => "方剂",
            "table" => "yanjyw",
            "where_clause" => " yaowulx='方剂'",
            "subject" => "yaolifl",
            "object" => "yaowumc",
            "db" => "中药药理实验数据库"
        )
    ),
    '中药' => array(
        array(
            "property" => "***属性信息",
            "object_type" => "av",
            "table" => "danweiyao",
            "subject" => "ZHONGYMC",
            "object" => array(
                "汉语拼音" => "HANYPY",
                "药用部位" => "YAOYBW",
                "安全剂量" => "ANQJL",
                "常规用法" => "CHANGGYF",
                "用药忌宜" => "YONGYJY",
                "各家论述" => "GEJLS",
                "考证" => "KAOZ",
                "出处" => "CHUC",
                "参考文献" => "CHANKWX"
            ),
            "db" => "中药基础信息数据库"
        ),
        array(
            "property" => "***包含的化学成分",
            "object_type" => "中药化学成分",
            "where_clause" => " yaowulx='单味药'",
            "table" => "yanjyw",
            "subject" => "yaowumc",
            "object" => "huaxuecf",
            "db" => "中药药理实验数据库"
        ),
        array(
            "property" => "***药理作用",
            "object_type" => "药理作用",
            "where_clause" => " yaowulx='单味药'",
            "table" => "yanjyw",
            "subject" => "yaowumc",
            "object" => "yaolifl",
            "db" => "中药药理实验数据库"
        ),
        array(
            "property" => "***相关化学实验",
            "object_type" => "rows",
            "table" => "huaxuesy",
            "subject" => "shiydx",
            "object" => array("题目" => "title", "作者" => "author", "单位" => "unit", "年份" => "year"),
            "db" => "中药化学实验数据库"
        ),
        array(
            "property" => "***来源处方",
            "object_type" => "方剂",
            "where_clause" => " yaowulx='单味药'",
            "table" => "yanjyw",
            "subject" => "yaowumc",
            "object" => "fangji",
            "db" => "中药药理实验数据库"
        )
    ),
    '化学实验方法' => array(
        array(
            "property" => "使用***的化学成分",
            "object_type" => "中药化学成分",
            "table" => "huaxcftq",
            "subject" => "tiqff",
            "object" => "tiqwmc",
            "db" => "中药化学实验数据库"
        ),
        array(
            "property" => "使用***的化学成分",
            "object_type" => "中药化学成分",
            "table" => "huaxcffl",
            "subject" => "fenlff",
            "object" => "fenlwmc",
            "db" => "中药化学实验数据库"
        ),
        array(
            "property" => "使用***的化学成分",
            "object_type" => "中药化学成分",
            "table" => "huaxcfhc",
            "subject" => "hecff",
            "object" => "hecwmc",
            "db" => "中药化学实验数据库"
        ),
        array(
            "property" => "使用***的化学成分",
            "object_type" => "中药化学成分",
            "table" => "huaxcfjd",
            "subject" => "jiandff",
            "object" => "jiandwmc",
            "db" => "中药化学实验数据库"
        ),
        array(
            "property" => "使用***的化学成分",
            "object_type" => "中药化学成分",
            "table" => "huaxcfch",
            "subject" => "chunhff",
            "object" => "chunhwmc",
            "db" => "中药化学实验数据库"
        ),
        array(
            "property" => "使用***的化学成分",
            "object_type" => "中药化学成分",
            "table" => "hanlcd",
            "subject" => "cedff",
            "object" => "jiancpmc",
            "db" => "中药化学实验数据库"
        )
    ),
    '方剂' => array(
        array(
            "property" => "***属性信息",
            "object_type" => "av",
            "table" => "Zyfj",
            "subject" => "fangm",
            "object" => array(
                "别名" => "BIEM",
                "处方来源" => "CHUFLY",
                "药物组成" => "YAOWZC",
                "加减" => "JIAJ",
                "功效" => "GONGX",
                "主治" => "ZUZ",
                "制备方法" => "ZHIBFF",
                "用法用量" => "YONGFYL",
                "用药禁忌" => "YONGYJJ",
                "临床应用" => "LINCYY",
                "药理作用" => "YAOLZY",
                "各家论述" => "GEJLS",
                "备注" => "BEIZ"
            ),
            "db" => "中国方剂数据库"
        ),
        array(
            "property" => "***组方加减",
            "object_type" => "中药",
            "where_clause" => " yaowulx='方剂'",
            "table" => "yanjyw",
            "subject" => "yaowumc",
            "object" => "danweiy",
            "db" => "中药药理实验数据库"
        ),
        array(
            "property" => "***包含的化学成分",
            "object_type" => "化学成分",
            "where_clause" => " yaowulx='方剂'",
            "table" => "yanjyw",
            "subject" => "yaowumc",
            "object" => "huaxuecf",
            "db" => "中药药理实验数据库"
        ),
        array(
            "property" => "***作为实验对象的化学实验",
            "object_type" => "rows",
            "table" => "huaxuesy",
            "subject" => "shiydx",
            "object" => array("题目" => "title", "作者" => "author", "单位" => "unit", "年份" => "year"),
            "db" => "中药化学实验数据库"
        ),
        array(
            "property" => "具有药理作用",
            "object_type" => "药理作用",
            "table" => "yanjyw",
            "where_clause" => " yaowulx='方剂'",
            "subject" => "yaowumc",
            "object" => "yaolifl",
            "db" => "中药药理实验数据库"
        )
    ),
    '中药化学成分' => array(
        array(
            "property" => "***属性信息",
            "object_type" => "av",
            "table" => "huaxuecf",
            "subject" => "zhongwmc",
            "object" => array(
                "化学分类号" => "HUAXFEL",
                "分子量" => "FENZL",
                "分子式" => "FENZS",
                "化学名称" => "HUAXMC",
                "熔点" => "RONGD",
                "颜色" => "YANS",
                "性状" => "XINGZ",
                "溶解性" => "RONGJX",
                "出处" => "CHUC"
            ),
            "db" => "中药基础信息数据库"
        ),
        array(
            "property" => "包含***的单味药",
            "object_type" => "中药",
            "where_clause" => " yaowulx='化学成分'",
            "table" => "yanjyw",
            "subject" => "yaowumc",
            "object" => "danweiy",
            "db" => "中药药理实验数据库"
        ),
        array(
            "property" => "包含***的方剂",
            "object_type" => "方剂",
            "where_clause" => " yaowulx='化学成分'",
            "table" => "yanjyw",
            "subject" => "yaowumc",
            "object" => "fangji",
            "db" => "中药药理实验数据库"
        ),
        array(
            "property" => "***药理作用",
            "object_type" => "药理作用",
            "where_clause" => " yaowulx='化学成分'",
            "table" => "yanjyw",
            "subject" => "yaowumc",
            "object" => "yaolifl",
            "db" => "中药药理实验数据库"
        ),
        array(
            "property" => "***相关化学实验",
            "object_type" => "化学实验方法",
            "table" => "huaxcftq",
            "subject" => "tiqwmc",
            "object" => "tiqff",
            "db" => "中药化学实验数据库"
        ),
        array(
            "property" => "***相关化学实验",
            "object_type" => "化学实验方法",
            "table" => "huaxcffl",
            "subject" => "fenlwmc",
            "object" => "fenlff",
            "db" => "中药化学实验数据库"
        ),
        array(
            "property" => "***相关化学实验",
            "object_type" => "化学实验方法",
            "table" => "huaxcfhc",
            "subject" => "hecwmc",
            "object" => "hecff",
            "db" => "中药化学实验数据库"
        ),
        array(
            "property" => "***相关化学实验",
            "object_type" => "化学实验方法",
            "table" => "huaxcfjd",
            "subject" => "jiandwmc",
            "object" => "jiandff",
            "db" => "中药化学实验数据库"
        ),
        array(
            "property" => "***相关化学实验",
            "object_type" => "化学实验方法",
            "table" => "huaxcfch",
            "subject" => "chunhwmc",
            "object" => "chunhff",
            "db" => "中药化学实验数据库"
        ),
        array(
            "property" => "***相关化学实验",
            "object_type" => "化学实验方法",
            "table" => "hanlcd",
            "subject" => "jiancpmc",
            "object" => "cedff",
            "db" => "中药化学实验数据库"
        )
    ),
    '疾病' => array(
        array(
            "property" => "治疗用单味药",
            "object_type" => "中药",
            "where_clause" => " yaowulx='单味药'",
            "table" => "yaolsy_yanjyw_wenxian",
            "subject" => "duixiangmc",
            "object" => "yaowumc",
            "db" => "中药药理实验数据库"
        ),
        array(
            "property" => "治疗用化学成分",
            "object_type" => "化学成分",
            "where_clause" => " yaowulx='化学成分'",
            "table" => "yaolsy_yanjyw_wenxian",
            "subject" => "duixiangmc",
            "object" => "yaowumc",
            "db" => "中药药理实验数据库"
        ),
        array(
            "property" => "治疗用方剂",
            "object_type" => "方剂",
            "where_clause" => " yaowulx='方剂'",
            "table" => "yaolsy_yanjyw_wenxian",
            "subject" => "duixiangmc",
            "object" => "yaowumc",
            "db" => "中药药理实验数据库"
        ),
        array(
            "property" => "相关病理环节",
            "object_type" => "药理作用",
            "table" => "yaolsy_yanjyw_wenxian",
            "subject" => "duixiangmc",
            "object" => "yaolifl",
            "db" => "中药药理实验数据库"
        )
    )
);

//if ((!isset($_GET['name'])) || (!isset($_GET['type']))) {

   // include_once("./exp_examples.php");
//} else {
    //$entity_name = $_GET['name'];
    //$entity_type = $_GET['type'];
    $entity_name = $name;
    
    ?>

    <div class ="container">
        <!--
        <a href="<?php echo $_SERVER[PHP_SELF]; ?>">查看实例>></a>
        <h1><?php //echo $entity_name . "（" . $entity_type . "）"; ?></h1>
        
        -->
<hr>
        <?php
        foreach ($schema[$entity_type] as $mapping) {
            $property = $mapping["property"];
            $table = $mapping["table"];
            $subject = $mapping["subject"];
            $object_type = $mapping["object_type"];
            $object = $mapping["object"];
            $db = $mapping["db"];
            $where_clause = $mapping["where_clause"];

            if (is_string($object)) {
                $values = array();
                $query = "SELECT $object FROM $table WHERE $subject = '$entity_name' and $object is not null";
                if (isset($where_clause)) {
                    $query .= " and " . $where_clause;
                }

                $result = mysqli_query($dbc, $query) or die('Error querying database:' . $query);
                while ($row = mysqli_fetch_array($result)) {
                    foreach (explode('$', $row[0]) as $v){
                        if ((is_legal($v))&&(!in_array($v, $values))){
                            $values[] = $v;
                        }
                    }                  
                }

                if (count($values) > 0) {
                    ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo $property; ?></h3>
                        </div>

                        <ul class="nav nav-pills">
                            <?php
                            foreach ($values as $value) {

                                echo '<li >';
                                if ($object_type == 'literal') {
                                    echo $value;
                                } else {
                                    echo '<a href="' . $_SERVER["PHP_SELF"] . '?db_name='. $db_name . '&type=' . $object_type . '&name=' . $value . '">' . $value . '</a>';
                                }

                                echo '</li>';
                            }
                            ?>
                        </ul>
                        <div class="panel-footer">
                            (数据来源:&nbsp;<a href="#"><?php echo $db; ?></a>)
                        </div>
                    </div>
                    <?php
                }
            } elseif (is_array($object)) {
                $query = "SELECT " . implode(',', $object) . " FROM $table WHERE $subject = '$entity_name' ";
                if (isset($where_clause)) {
                    $query .= " and " . $where_clause;
                }
                $result = mysqli_query($dbc, $query) or die('Error querying:' . $query);
                if (mysqli_num_rows($result) > 0) {
                    ?>
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo $property; ?></h3>
                        </div>
                        <div class="panel-info">
                            <?php
                            if ($object_type == 'rows') {
                                echo " <table><thead>";
                                foreach (array_keys($object) as $obj) {
                                    echo "<th>" . $obj . "</th>";
                                }
                                echo "</thead>";
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                    foreach ($object as $obj) {
                                        echo '<td>' . $row[$obj] . '</td>';
                                    }
                                    echo "</tr>";
                                }
                                echo " </table>";
                            } elseif ($object_type == 'av') {
                                echo " <table>";
                                $first = true;

                                while ($row = mysqli_fetch_array($result)) {
                                    if ($first) {
                                        $first = false;
                                    } else {
                                        echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
                                    }

                                    foreach ($object as $attribute => $obj) {
                                        if (is_legal($row[$obj])) {
                                            echo "<tr>";
                                            echo "<th width='20%'>" . $attribute . "</th>";
                                            echo '<td>' . $row[$obj] . '</td>';
                                            echo "</tr>";
                                        }
                                    }
                                }
                                echo " </table>";
                            }
                            ?>                   

                        </div>
                        <div class="panel-footer">
                            (数据来源:&nbsp;<a href="#"><?php echo $db; ?></a>)
                        </div>
                    </div>
                    <?php
                }
            }
        }
        ?>
    </div>

    <?php
//}
/*
include_once ("./foot.php");

 * 
 */
?>