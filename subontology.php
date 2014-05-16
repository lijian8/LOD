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
    $delimiters = array(","," ",'；', ';', '，', "、", ".", "。");
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
        <div class="container">
            <h1><font face="微软雅黑">中医药子本体抽取工具</font></h1>
        </div>       
        <hr>
        <div class="col-lg-6">


            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-horizontal"
                  enctype="multipart/form-data">
                <div class="container">

                    <input  type="hidden" id="db_name" name="db_name" value = "<?php if (isset($db_name)) echo $db_name; ?>" >
                    <div class="form-group">
                        <a href="subontology.php" class="btn btn-default ">清空</a>
                        <div class="btn-group">
                            <a class="btn btn-default" href="baidu.htm">中医药学语言系统</a>




                            <div class="pull-right btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">

                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li> <a  href="#">中医古籍语言系统</a></li>
                                    <li><a class="btn btn-default" href="#">中医临床术语集</a></li>
                                </ul>
                            </div>

                        </div>   

                        <input class="pull-right btn btn-primary" type="submit" name="submit" value="匹配" />             

                    </div>
                </div>
                <textarea class="form-control"  id="keywords" name="keywords"  placeholder="请输入词汇列表" rows="30"><?php if (isset($keywords)) echo $keywords; ?></textarea>
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

            <div class="container">


                <div class="btn-group pull-right">

                    <form role="form" action="export_ontology.php" method="post" 
                          enctype="multipart/form-data">
                        <input  type="hidden" id="keyword_array" name="keyword_array" value = "<?php echo implode("$", $id_array); ?>" >
                        <input  type="hidden" id="db_name" name="db_name" value = "<?php if (isset($db_name)) echo $db_name; ?>" >

                        <div class="btn-group">
                            <input class="btn btn-default" type="submit" name="submit" value="导出TTL文件"/>  
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">

                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li> <input  class="btn btn-link" type="submit" name="submit" value="导出OWL文件"/>   </li>
                                <li>  <input class="btn btn-link" type="submit" name="submit" value="导出RDF/XML文件"/>   </li>
                                <li>  <input class="btn btn-link" type="submit" name="submit" value="导出CSV文件"/>   </li>
                            </ul>
                        </div>
                    </form>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#home" data-toggle="tab"> 识别出的概念（<?php echo count($found); ?>）</a></li>
                    <li><a href="#profile" data-toggle="tab">未识别出的概念（<?php echo count($unfound); ?>）</a></li>
                </ul>
                <br>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="home">
                        <div class="well"  style="height:600px; overflow-y:auto;">



                            <ul class="nav nav-pills"> 
                                <?php
                                foreach ($found as $item) {
                                    echo '<li>' . $item . '</li>';
                                }
                                ?>                      
                            </ul> 



                        </div>
                    </div>
                    <div class="tab-pane" id="profile">
                        <div class="well"  style="height:600px; overflow-y:auto;">
                            <ul class="nav nav-pills"> 
                                <?php
                                foreach ($unfound as $item) {
                                    echo '<li><a href="#">' . $item . '</a></li>';
                                }
                                ?>                      
                            </ul>
                        </div>

                    </div>

                </div>


            </div>

        </div>
    </div>
    <hr>
</div>

<?php
include_once ("./foot.php");
?>
