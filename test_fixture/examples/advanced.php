<?php require "../extensions/class.improvedtest.php"; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PHP Test Fixture ("Algorithm Tester") - An Advanced Example involving Inheritance</title>
  </head>
  <body>
    <h1>Example with Custom Test Fixture</h1>
    <h2>Exercise</h2>
    <p>
      Create an algorithm that accepts an array of numbers of any size and <code>return</code>s the mean average of the integers.  If your algorithm is correct, it should pass all the tests below and you should see a green button.  If not, you should see a red button.
    </p>
    <?php
    function mean_avg($nums) {
      // Write your code here.  Good Luck :D
    }
    ?>
    <h2>Tests</h2>
    <h3>Expectations</h3>
    <?php
    $custom_test = new ImprovedTest();
    $custom_test->expect(mean_avg(array(1,2,3)) === 2);
    $custom_test->expect(mean_avg(array(1,2,3,4,5)) === 3);
    $custom_test->expect(mean_avg(array(3,10,345,54,3)) === 83);
    $custom_test->expect(mean_avg(array(1,6,7,344,65,-45,34,7)) === 52.375);
    ?>
    <h3>Equality Tests</h3>
    <?php
    $custom_test->assert_equals(mean_avg(array(3,7,11,15,19)), 11);
    $custom_test->assert_equals(mean_avg(array(10,50,33,27,30)), 30);
    $custom_test->assert_equals(round(mean_avg(array(849,396,204,593,998,1904,928,645,199)), 2), 746.22);
    ?>
    <h3>Inequality Tests</h3>
    <p>
      No need for inequality tests :)
    </p>
    <h3>Results</h3>
    <?php
    $algorithm_passed = $custom_test->print_summary();
    echo ($algorithm_passed === true) ? "<a href='#' class='pass'>Submit Final</a>" : "<a href='#' class='fail'>Try Again</a>";
    ?>
    <style media="screen">
      .fail {
        background-color: red;
        padding: 5px 10px;
        border-radius: 5px;
        text-decoration: none;
        color: #000;
      }
      .pass {
        background-color: lime;
        color: #000;
        padding: 5px 10px;
        text-decoration: none;
        border-radius: 5px;
      }
    </style>
  </body>
</html>
