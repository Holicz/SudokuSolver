<?php
  require_once('sudokuSolver.php');
  use sudokuSolver\sudokuSolver;

  if (isset($_POST['solve'])) {

    for ($i=0; $i < 9; $i++) {  
      for ($k=0; $k < 9; $k++) {
        $sudoku[$i][$k] = intval($_POST['number-'.$i.$k]);
      }
    }

    $solver = new SudokuSolver($sudoku);

    if ($solver->solve()) {
      $sudokuValues = $solver->returnSudoku();
    } else {
      header("location: ?no_solution");
    }

  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Sudoku solver">
    <meta name="author" content="Lukáš Holeczy">

    <title>Lukáš Holeczy - sudoku solver</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="http://getbootstrap.com/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="styles.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item active" href="index.php">Sudoku solver</a>
        </nav>
      </div>
    </div>

    <div class="container">

      <div class="blog-header">
        <h1 class="blog-title">Sudoku solver</h1>
        <p class="lead blog-description">Program, který vystihuje jednoho programátora</p>
      </div>

      <div class="row">

        <div class="col-sm-8 blog-main">

          <p>Vše co mělo být řečeno už řečeno bylo, v soutěžním příspěvku. Nyní zbývá aplikaci, pokud chcete, vyzkoušet. Stačí zadat nějaká čísla, kliknout a sudoku se vyřeší.</p>

          <p>Aplikace byla vytvořena z důvodu účasti v soutěži <a href="http://unicorncollege.cz/sudoku.html" target="_blank" title="Unicorn College - soutěž Sudoku">Sudoku od Unicorn College.</a></p>

          <p>Zdrojové kódy jsou k dispozici na <a href="https://github.com/Holicz/SudokuSolver" target="_blank" title="Github">Githubu</a>.</p>

          <?php if(isset($_POST['solve'])) : ?>

            <table>
              <?php 
              foreach ($sudokuValues as $sudokuLines) { 
                echo '<tr>';
                foreach ($sudokuLines as $sudokuCells) { 
                  echo '<td>'.$sudokuCells.'</td>';
                }
                echo '</tr>';
              }
              ?>
            </table>

            <a href="index.php" class="btn btn-primary btn-lg">Zpět</a>

          <?php else: ?>

            <?php if(isset($_GET['no_solution'])) : ?>
              <div class="alert alert-danger" role="alert">Toto sudoku nemá řešení.</div>
            <?php endif; ?>

            <form method="post">
              <table>
                <?php 
                for ($i=0; $i < 9; $i++) { 
                  echo '<tr>';
                  for ($k=0; $k < 9; $k++) { 
                    echo '<td><input type="number" maxlength="1" min="1" max="9" name="number-'.$i.$k.'"></td>';
                  }
                  echo '</tr>';
                }
                ?>
              </table>
              <input type="submit" value="Vyřešit" name="solve" class="btn btn-primary btn-lg">
              <a onclick="fillInSampleSudoku()" class="btn btn-primary btn-lg">Předvyplnit sudoku</a>
              <input type="reset" value="Vymazat" name="solve" class="btn btn-danger btn-lg pull-right">
            </form>

          <?php endif; ?>

        </div><!-- /.blog-main -->

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>O autorovi</h4>
            <p>Před sedmi lety začal s tvorbou webů, programování ho bavilo a nebál se ničeho. Za sedm let zaznamenal tři zásadní zlomy (a další je blízko) - účast ve studijním programu <a href="https://www.microsoft.com/cze/education/students/STC/" target="_blank" title="STC">STC od Microsoftu</a>, vítězství v <a href="http://www.juniorinternet.cz/" target="_blank" title="Junior Internet">Junior Internetu</a> a nejzásadnější zlom, účast na <a href="http://www.tyinternety.cz/reportaze-z-akci/dva-mesice-od-rana-do-vecera-takovy-je-code-camp-narocny-kurz-pro-programatory/" target="_blank" title="Code Camp 2015">Code Campu 2015</a>.</p>
          </div>
          <div class="sidebar-module">
            <h4>Odkazy</h4>
            <ol class="list-unstyled">
              <li><a href="https://github.com/Holicz/SudokuSolver" title="Github">GitHub projektu</a></li>
              <li><a href="http://lukasholeczy.eu" target="_blank" title="Osobní web lukasholeczy.eu">Osobní web</a></li>
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->

    <footer class="blog-footer">
      <p>Blog template built for <a href="http://getbootstrap.com" title="Bootstrap">Bootstrap</a> by <a href="https://twitter.com/mdo" title="Twitter: @mdo">@mdo</a>.</p>
      <p>Lukáš Holeczy 2016</p>
      <p>
        <a href="#">Nahoru</a>
      </p>
    </footer>

    <script type="text/javascript">
      function fillInSampleSudoku()
      {
        document.getElementsByName("number-03")[0].value = '2';
        document.getElementsByName("number-05")[0].value = '6';
        document.getElementsByName("number-08")[0].value = '3';
        document.getElementsByName("number-11")[0].value = '6';
        document.getElementsByName("number-14")[0].value = '8';
        document.getElementsByName("number-21")[0].value = '7';
        document.getElementsByName("number-22")[0].value = '1';
        document.getElementsByName("number-25")[0].value = '3';
        document.getElementsByName("number-32")[0].value = '6';
        document.getElementsByName("number-36")[0].value = '9';
        document.getElementsByName("number-37")[0].value = '1';
        document.getElementsByName("number-42")[0].value = '7';
        document.getElementsByName("number-43")[0].value = '8';
        document.getElementsByName("number-45")[0].value = '9';
        document.getElementsByName("number-46")[0].value = '6';
        document.getElementsByName("number-51")[0].value = '2';
        document.getElementsByName("number-52")[0].value = '4';
        document.getElementsByName("number-56")[0].value = '8';
        document.getElementsByName("number-63")[0].value = '1';
        document.getElementsByName("number-66")[0].value = '5';
        document.getElementsByName("number-67")[0].value = '4';
        document.getElementsByName("number-74")[0].value = '3';
        document.getElementsByName("number-77")[0].value = '8';
        document.getElementsByName("number-80")[0].value = '2';
        document.getElementsByName("number-83")[0].value = '6';
        document.getElementsByName("number-85")[0].value = '8';
      }      
    </script>
  </body>
</html>
