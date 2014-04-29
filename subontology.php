<?php
include_once ("./header.php");
include_once ("./onto_array.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./db_helper.php");


function identify($dbc, $name) {

    $query = "select id, def from def where name = '$name'";
    $result = mysqli_query($dbc, $query) or die('Error querying database1.');
    $ids = array();
    while ($row = mysqli_fetch_array($result)) {
        $ids[] = $row[id];
    }
    return $ids;
}

function process_keywords($keywords) {
    $delimiters = array(",", '，', "、", ".", "。");
    $keywords = preg_replace('/\\r?\\n|\\r/', '$', $keywords);
    foreach ($delimiters as $delimiter) {
        $keywords = str_replace($delimiter, '$', $keywords);
    }
    $keyword_array = explode('$', $keywords);
    $clean_keyword_array = array();
    foreach ($keyword_array as $keyword) {
        $keyword = str_replace('$', '', $keyword);
        if (($keyword != '') && (!in_array($keyword, $clean_keyword_array))) {
            $clean_keyword_array[] = $keyword;
        }
    }
    return $clean_keyword_array;
}

if (isset($_POST['submit'])) {
    $keywords = $_POST['keywords'];
    $keyword_array = process_keywords($keywords);
}
?>
<div class="container">
    <div class="row">

        <h1>子本体导出工具</h1>
        <hr>
        <div class="col-lg-6">


            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-horizontal"
                  enctype="multipart/form-data">
                <input  type="hidden" id="db_name" name="db_name" value = "<?php if (isset($db_name)) echo $db_name; ?>" >
                <div class="form-group">
                    <div class="col-sm-10">
                        <input class="btn btn-primary" type="submit" name="submit" value="匹配" />    

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <textarea class="form-control" id="keywords" name="keywords"  placeholder="请输入词汇列表" rows="30"><?php if (isset($keywords)) echo $keywords; ?></textarea>
                    </div>
                </div>
            </form>

        </div>
        <div class="col-lg-6">

            <?php
            $found = array();
            
            $id_array = array();

            $unfound = array();
            foreach ($keyword_array as $keyword) {
                $ids = identify($dbc, $keyword);

                foreach ($ids as $id) {
                    $found[] = get_entity_link($id, $keyword, $db_name);
                    $id_array[] = $id;
                }

                if (count($ids) == 0) {
                    $unfound[] = $keyword;
                }
            }
            ?>

            <h1>识别出的概念（<?php echo count($found); ?>）：</h1>    
            <form role="form" action="export_turtle_ontology.php" method="post" class="form-horizontal"
                  enctype="multipart/form-data">
                <input  type="hidden" id="keyword_array" name="keyword_array" value = "<?php echo implode("$", $id_array); ?>" >
                <input  type="hidden" id="db_name" name="db_name" value = "<?php if (isset($db_name)) echo $db_name; ?>" >
                <div class="form-group">
                    <div class="col-sm-10">
                        <input class="btn btn-primary" type="submit" name="submit" value="全部导出"/>   
                    </div>
                </div>             
            </form>

            <ul class="nav nav-pills"> 
                <?php
                if (count($found) == 0) {
                    echo '<li>无</li>';
                }

                foreach ($found as $item) {
                    echo '<li>' . $item . '</li>';
                }
                ?>                      
            </ul>


            <h1>未识别出的概念（<?php echo count($unfound); ?>）：</h1>                                     
            <ul class="nav nav-pills"> 
                <?php
                if (count($unfound) == 0) {
                    echo '<li>无</li>';
                }

                foreach ($unfound as $item) {
                    echo '<li>' . $item . '</li>';
                }
                ?>                      
            </ul>
        </div>
    </div>
    <hr>
</div>

<?php
include_once ("./foot.php");
?>
