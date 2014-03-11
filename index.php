<?php
$randNumbers = array();
if((int) $_POST['i_count'] === 1){
  $min = $_POST['p_buffer']+$_POST['p_length']/2;
  $max = $_POST['i_length']-$_POST['p_buffer']-$_POST['p_length']/2;
  $randNumbers[1] = mt_rand($min, $max);
}else{
  //$randNumbers[0] = 0;
  $randNumbers[0] = $_POST['p_buffer'];
  $maxLengthOfSection = (($_POST['i_length']-2*$_POST['p_buffer'])-($_POST['i_count']-1)*$_POST['p_buffer'])/$_POST['i_count'];

  for ($i=1; $i <= $_POST['i_count']; $i++) {
    $j = ($i === 1) ? $_POST['i_count'] : $_POST['i_count']-$i;
    //$randNumbers[$i] = mt_rand($randNumbers[$i-1]+($_POST['p_length']/2)+$_POST['p_buffer'], $_POST['i_length']-$_POST['p_buffer']-(($j)*$_POST['p_length']+($j)*$_POST['p_buffer']));
    $randNumbers[$i] = mt_rand(($i-1)*$maxLengthOfSection+($i)*$_POST['p_buffer'], $i*$maxLengthOfSection+($i)*$_POST['p_buffer']);
  }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Random Numbers for Beavers</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- Le styles -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet"> -->
    <!-- Le fav and touch icons -->
  </head>

  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="page-title">Random Numbers for Beavers</h1>
          <h2>Input</h2>
          <form action="index.php" method="POST" role="form">
            <fieldset>
              <legend>Input data</legend>
              <div class="form-group col-md-4">
                <label for="i_length">available length for beaver habitat</label>
                <div class="input-group">
                  <input required type="number" class="form-control" id="i_length" name="i_length">
                  <span class="input-group-addon">m</span>
                </div>
              </div>
              <div class="form-group col-md-4">
                <label for="i_count">number of habitats</label>
                <input required type="number" class="form-control" id="i_count" name="i_count">
              </div>
            </fieldset>
            <fieldset>
              <legend>Parameters</legend>
              <div class="form-group col-md-4">
                <label for="p_length">length of beaver section</label>
                <div class="input-group">
                  <input required type="number" class="form-control" id="p_length" name="p_length" value=1866>
                  <span class="input-group-addon">m</span>
                </div>
              </div>
              <div class="form-group col-md-4">
                <label for="p_buffer">buffer size</label>
                <div class="input-group">
                  <input required type="number" class="form-control" id="p_buffer" name="p_buffer" value=100>
                  <span class="input-group-addon">m</span>
                </div>
              </div>
            </fieldset>
            <hr>
            <button type="submit" class="btn btn-primary col-md-4 col-md-offset-4">Submit</button>
          </form>
          <div class="clearfix"></div>
          <br>
          <h2>Output</h2>
          <ol>
          <?php unset($randNumbers[0]); foreach($randNumbers as $i => $midPoint): ?>
            <li>[<?=$midPoint-$_POST['p_length']/2?>, <?=$midPoint+$_POST['p_length']/2?>] centered at <?=$midPoint?></li>
          <?php endforeach; ?>
          </ol>
          <pre><?php var_dump($randNumbers);?></pre>
        </div>
      </div>
    </div><!--/.container-->
  </body>
</html>

