<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<img width ="100%" src ="img/TCM_Semantic_Network_logo.jpg"></img> 
<ul class="nav nav-tabs">
      <li <?php if ($sn_name == 'sn_list') echo 'class="active"'; ?>><a href="sn_list.php" >语义网络汇总</a></li>
   
   <li <?php if ($sn_name == 'tcmls') echo 'class="active"'; ?>><a href="sn_profile.php?db_name=tcmls" >中医药学语言系统</a></li>   
    <li <?php if ($sn_name == 'tcmct') echo 'class="active"'; ?>><a href="sn_profile.php?db_name=tcmct" >中医临床术语集</a></li>   
    <li <?php if ($sn_name == 'clan') echo 'class="active"'; ?>><a href="sn_profile.php?db_name=clan" >中医古籍语言系统</a></li>   
    <li <?php if ($sn_name == 'spleen') echo 'class="active"'; ?>><a href="sn_profile.php?db_name=spleen" >中医脾系证候知识库</a></li>   
    <li <?php if ($sn_name == 'sn_compare') echo 'class="active"'; ?>><a href="sn_compare_main.php" >语义网络比较</a></li>  
</ul>