<?php
include_once ("./header.php");
?>
<div  class="container">
    <img width ="100%" src ="img/tcmls_text_mining.jpg"></img>    



    <div class="container">
        <br> 
        <p class="lead"><strong>项目介绍</strong></p>
        <p>中医药学语言系统是中国中医科学院中医药信息研究所于2002年起开始研制的一项大型中医药术语系统，语义网络是语言系统的重要组成部分。为了促进中医药学语言系统的发展，提高系统中语义关系的准确性，本课题拟进行基于文本的中医药语义关系发现研究，以求通过对中医药文献的文本进行分析，并与中医药学语言系统现有语义网络结合，得到准确的语义关系。
        <p>在本项目中，我们主要完成了3项工作：
        <ol>
            <li>基于TCMLS从文本中抽取语义关系，构成了一个“文献库”；</li>                
            <li>从“文献库”和TCMLS中，分别归纳出基于语义类型的语义网络(即“顶层语义网络”), 对<a href="sn_profile.php?db_name=docs" target="_blank">“文献库”的顶层语义网络</a>和<a href="sn_profile.php?db_name=tcmls" target="_blank">TCMLS的顶层语义网络</a>进行比较。</li>  
        </ol> 
        在此介绍语义网络的归纳、浏览和比较的方法和结果，欲知从文本中抽取语义关系的方法请点击&nbsp;<a href="/docs/project_relation.php">这里&nbsp;》</a>
        </p>
        <hr>
        <p class="lead"><strong>语义网络归纳方法</strong></p>    
        <p>在TCMLS中，我们为每个概念都赋予了至少一个语义类型。例如，“气虚证”的语义类型为“证候”，“四君子汤”的语义类型为“方剂”等等。
            我们在这里所做的工作，就是将概念之间的语义关系，归纳总结为语义类型之间的语义关系。例如：
        <ul>
            <li>大黄的语义类型是中药，腹痛的语义类型是疾病，从类似于“大黄 治疗 腹痛”的一系列语义关系中，可以总结出“<a href="sn_triple_type.php?db_name=tcmls&type=23124">中药 治疗 疾病</a>”。</li>
            <li>肝火上炎的语义类型是证候，眩晕的语义类型是中医疾病，从类似于“肝火上炎 被包含 眩晕”的一系列语义关系中，可以总结出“<a href="sn_triple_type.php?db_name=tcmls&type=20557">证候 被包含 中医疾病</a>”。</li>  
        </ul>
        如下图所示，所有这些语义关系可被融合成一个基于语义类型的语义网络，即顶层语义网络。</p>
        <img width ="100%" src ="img/tcmls/语义网络.jpg"></img>    
        语义关系的形式为（语义类型、语义关系名称、语义类型、实例数量、...），其中：
        <ul>
            <li>语义类型（如“中药”、“疾病”）来自“中医药学语言系统”；</li>
            <li>语义关系名称（如“治疗”）可以来自“中医药学语言系统”，也可以是新颖的；</li>
            <li>“中药 治疗 疾病”的实例数量是指“大黄 治疗 腹痛”这类具体的语义关系的数量。</li>
        </ul>
        我们将所发现的语义关系存入一个MySQL数据库中。其中的数据可以通过可读文本文件的形式输出，其中包括可由Excel软件打开和处理的文件形式 (Excel形式为“主——谓——宾”形式) ；
        或通过下文所述的语义网络浏览工具进行浏览。</p>

        <p class="lead"><strong>语义网络浏览工具</strong></p>
        <p>如上文所述，顶层语义网络就是通过语义关系将语义类型连接起来所构成的网络。如下图所示，<a href="sn_profile.php?db_name=tcmls" target="_blank">语义网络浏览工具</a>以Web的方式实现语义网络的浏览和展示功能。在界面左侧，统计每个语义类型的实例个数，并按实例数量大小顺序对语义类型进行排列。当用户选择某一类型时，系统会在右侧显示该类型涉及的语义关系。</p>
        <p align="center" >
            <a  href="sn_profile.php?db_name=tcmls" target="_blank">
                <img width ="60%" src ="img/语义网展示-TCMLS.jpg"></img> 
            </a>
        </p>
        <p>
            系统还提供了另一种语义网络展示工具，被称为“<a  href="sn_relation_search.php?db_name=tcmls" target="_blank">语义关系搜索</a>”。用户可以任选主体、谓词和客体的类型，系统则将符合条件的语义关系分门别类地展示出来。例如，用户若想了解“哪些类型的事物可以治疗证候”，则可选择主体为“任意事物”，谓词为“治疗”，客体为“证候”，系统会显示一个列表:“方剂 治疗 证候”、“治法 治疗 证候”、“食疗-药膳 治疗 证候”等等。对于每条顶层语义关系，系统都给出了一些实例供用户参考。例如，“方剂 治疗 证候”的例子包括“银花解毒汤 治疗 风热证”,“红轮散 治疗 热证”,“三光散 治疗 风淫证候”等等。用户若想查看更多的实例，可点击“查看更多>>”，则系统将转到语义关系搜索界面（以“方剂 治疗 证候”为例展示）。
        </p>  
        <p align="center" >
            <a  href="sn_relation_search.php?db_name=tcmls" target="_blank">
                <img width ="60%" src ="img/TCMLS语义关系搜索1.jpg"></img> 
            </a>
        </p>
        <hr>
        <p class="lead"><strong>语义网络比较工具</strong></p>
        我们对TCMLS的语义网络与从<a href="sn_profile.php?db_name=docs" target="_blank">文献文本中实际抽取的语义网络</a>进行了比较。如下图所示，我们开发了 <a  href="sn_compare.php?sdb_name=docs&tdb_name=tcmls" target="_blank">语义网络的比较界面</a>，它能够比较两个语义网络中类型的差异。其核心功能是在用户选定某个类后，比较该类在两个语义网络中的“用法”。系统首先列出了两个语义网络共有的语义类型，仅在文献库中出现的语义类型，以及仅在TCMLS中出现的语义类型。当用户选择一个语义类型（如：中药化学成分），系统会列出在两个语义网络中均出现的语义关系，以及仅出现在TCMLS或文献库中的语义关系。
        <p align="center" >
            <a  href="sn_compare.php?sdb_name=docs&tdb_name=tcmls" target="_blank">
                <img width="60%" src ="img/语义网络比较-文献库vsTCMLS1.jpg"></img> 
            </a>    
        </p>
        <br>
         <p align="center" >
            <a  href="sn_compare.php?sdb_name=docs&tdb_name=tcmls" target="_blank">
                <img width="60%" src ="img/语义网络比较-文献库vsTCMLS2.jpg"></img> 
            </a>    
        </p>
        如下表所示，我们还生成了源自文献的语义网络与TCMLS语义网络的  <a  href="sn_compare_report.php?sdb_name=docs&tdb_name=tcmls" target="_blank">
           比较报表</a>。
         <p align="center" >
            <a  href="sn_compare_report.php?sdb_name=docs&tdb_name=tcmls" target="_blank">
                <img width="60%" src ="img/语义网络比较报表-文献库vsTCMLS1.jpg"></img> 
            </a>    
        </p>
        
        <p class="lead"><strong>总结</strong></p>
        <p>本项目向术语专家提供新的技术能力，主要包括从语义关系中归纳“顶层语义网络”的技术能力，以及向术语专家提供从文本中发现新颖语义关系的技术能力。这项工作尚存在一些局限性。例如，我们尚缺乏判断文本语义关系准确类型的有效手段，也尚未实现发现新词的方法。另外，有些中医药领域的词汇尚未收入TCMLS之中，这影响了语义关系发现的效果。</p>
        <br>
        <p align="center"><a class="btn btn-lg btn-success" href="docs/语义网络浏览系统用户手册v1.docx" role="button"><span class="glyphicon glyphicon-cloud-download"></span>&nbsp;下载用户手册</a>
            &nbsp;<a class="btn btn-lg btn-primary" href="docs/于彤-基于文本挖掘发现中医药语义关系的方法探索研究-2013.12.27.docx" role="button"><span class="glyphicon glyphicon-book"></span>&nbsp;下载技术报告</a></p>

        <hr>


    </div> <!-- /container -->
</div>
<?php
include_once ("./foot.php");
?>