<?php
include_once ("./header.php");

if (isset($_GET['example'])) {
    include_once ($_GET['example'] . ".php");
} else {
    ?>
    <div align="center" class="container">
        <img width ="100%" src ="img/banner.jpg"></img>    
    </div>
    <br>
    <div class="container">
        <!--
        <div class="jumbotron">           
            <p class="lead">中国中医科学院中医药信息研究所长期致力于中医药领域数字资源的建设与利用工作，成功研制了中医药学语言系统、中医临床术语集等大型术语系统，以及结构性文献数据库(方剂数据库,医案数据库)。本网站集成了中医药领域的领域本体、术语资源（包括中医药学语言系统、中医临床术语集、中医古籍语言系统等），以及证候、中药、方剂等领域的知识库，面向中医专家提供知识检索、知识问答、知识浏览等服务。
            </p>
        </div>
        -->

        <div class="panel panel-default">
            <div class="panel-heading lead">中医药术语系统</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4">                        
                        <p class="lead"><a href="doc_spleen.php">中医药学语言系统</a></p>
                        <p class="lead">通过一些相对简单但较为完整的中医临床案例，分析中医辨证论治的思维过程，探讨基于本体推理和问答系统来支持中医临床决策的方法。</p>
                        <p><a class="btn btn-primary" href="<?php echo $_SERVER['PHP_SELF'] . '?example=syndrome'; ?>" role="button">查看详情 »</a></p>
                    </div>
                    <div class="col-lg-4">
                         <p class="lead"><a href="<?php echo $_SERVER['PHP_SELF'] . '?example=syndrome'; ?>">中医临床术语集</a></p>
                        <p> 证型是具有标准名称的证候类型，它是由包括阴阳、五行、脏腑和精微物质在内的中医术语所构成的复合概念。
                            证型之间通过层次关系构成一个层次结构；尽管不同病人的病理变化以及临床表现纷繁复杂，但运用证候层次结构可以对病情进行统一的分门别类。结合具体案例对中医证候知识和层次结构进行建模... </p>
                        <p><a class="btn btn-primary" href="<?php echo $_SERVER['PHP_SELF'] . '?example=syndrome'; ?>" role="button">查看详情 »</a></p>
                    </div>
                    <div class="col-lg-4">
                        <p class="lead">中医古籍语言系统</p>
                        <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
                        <p><a class="btn btn-primary" href="http://v3.bootcss.com/examples/justified-nav/#" role="button">查看详情 »</a></p>
                    </div>
                </div>
            </div>
        </div>


        <h1 font="微软雅黑">中医药术语系统</h1>
        <hr> 
        <div class="row">
            <div class="col-lg-4">
                <h2><a href="doc_spleen.php">中医药学语言系统</a></h2>                      
                <p class="lead">通过一些相对简单但较为完整的中医临床案例，分析中医辨证论治的思维过程，探讨基于本体推理和问答系统来支持中医临床决策的方法。</p>
                <p><a class="btn btn-primary" href="<?php echo $_SERVER['PHP_SELF'] . '?example=syndrome'; ?>" role="button">查看详情 »</a></p>


            </div>
            <div class="col-lg-4">
                <h2><a href="<?php echo $_SERVER['PHP_SELF'] . '?example=syndrome'; ?>">中医临床术语集</a></h2>
                <p> 证型是具有标准名称的证候类型，它是由包括阴阳、五行、脏腑和精微物质在内的中医术语所构成的复合概念。
                    证型之间通过层次关系构成一个层次结构；尽管不同病人的病理变化以及临床表现纷繁复杂，但运用证候层次结构可以对病情进行统一的分门别类。结合具体案例对中医证候知识和层次结构进行建模... </p>
                <p><a class="btn btn-primary" href="<?php echo $_SERVER['PHP_SELF'] . '?example=syndrome'; ?>" role="button">查看详情 »</a></p>
            </div>
            <div class="col-lg-4">
                <h2>中医古籍语言系统</h2>
                <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa.</p>
                <p><a class="btn btn-primary" href="http://v3.bootcss.com/examples/justified-nav/#" role="button">查看详情 »</a></p>
            </div>
        </div>

        <br> <br> 

        <h1>中医药知识集成</h1>
        <hr> 
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