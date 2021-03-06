<?php
  $path = $_SERVER['DOCUMENT_ROOT'];
  include_once($path."/gchart-display/template/header.php");
?>
<article class="mw9 center ph3 ph4-ns dt-l w-100 mv4">
  <!--We have a chart on this page-->
  <? include_once($path."/gchart-display/inc/js/gdashboard.php"); ?>
  <!--Div that will hold the dashboard-->
    <div id="poetry-dashboard" class="ba b--near-black bg-white">
      <div id="poetry-search" class="center w-50 pa2"></div>
      <div id="poetry-table" class="center w-50 ba b--near-black"></div>
      <div id="poetry-pie"></div>
    </div>
</article>
<?php
  include_once($path."/gchart-display/template/footer.php");
?>
