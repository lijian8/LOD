<?php
include_once ("./header.php");

if (isset($_GET['example'])) {
    include_once ($_GET['example'] . ".php");
} else {
    ?>
    <div class="container">

        <div class="jumbotron">
            <h1>中医药术语与本体服务平台</h1>
            <p class="lead">该平台集成了中医药领域的术语、本体和知识库资源。通过一些相对简单但较为完整的中医临床案例，分析中医辨证论治的思维过程，探讨基于本体推理和问答系统来支持中医临床决策的方法。</p>
        </div>
        <!-- Example row of columns -->
        <div class="row">
            <div class="col-lg-4">
                <h2><a href="doc_spleen.php">中医脾系证候知识库</a></h2>                      
            <p class="lead">通过一些相对简单但较为完整的中医临床案例，分析中医辨证论治的思维过程，探讨基于本体推理和问答系统来支持中医临床决策的方法。</p>
     

            </div>
            <div class="col-lg-4">
                <h2><a href="<?php echo $_SERVER['PHP_SELF'] . '?example=syndrome'; ?>">证候</a></h2>
                <p> 证型是具有标准名称的证候类型，它是由包括阴阳、五行、脏腑和精微物质在内的中医术语所构成的复合概念。
                    证型之间通过层次关系构成一个层次结构；尽管不同病人的病理变化以及临床表现纷繁复杂，但运用证候层次结构可以对病情进行统一的分门别类。结合具体案例对中医证候知识和层次结构进行建模... </p>
                <p><a class="btn btn-primary" href="<?php echo $_SERVER['PHP_SELF'] . '?example=syndrome'; ?>" role="button">查看详情 »</a></p>
            </div>
            <div class="col-lg-4">
                <h2>方剂</h2>
                <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
                <p><a class="btn btn-primary" href="http://v3.bootcss.com/examples/justified-nav/#" role="button">查看详情 »</a></p>
            </div>
        </div>
       
        <hr>
    </div> <!-- /container -->

    <?php
}
include_once ("./foot.php");
?>