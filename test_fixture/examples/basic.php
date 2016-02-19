<?php require "../class.test.php"; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PHP Test Fixture (Algorithm-Testing Framework) - A Basic Example</title>
  </head>
  <body>
    <h1>Basic Example - Testing an Algorithm that squares all numbers in an array and returns the sum of the squares</h1>
    <h2>Initial Test - Valid Algorithm</h2>
    <p>
      In the case of a valid algorithm, it should pass every test you throw at it no matter how many there are.  When the test summary is printed it should read <code>0 Failed</code> and the algorithm should pass.
    </p>
    <p>
      See actual PHP source code for more details.
    </p>
    <h3>Algorithm Code</h3>
    <p>
<pre style="color:white;background-color:black;padding:10px;border-radius:3px;"><code>function square_n_sum($nums) {
  for ($i = 0; $i &lt; sizeof($nums); $i++) {
    $nums[$i] *= $nums[$i];
  }
  $sum_of_squares = 0;
  for ($i = 0; $i &lt; sizeof($nums); $i++) {
    $sum_of_squares += $nums[$i];
  }
  return $sum_of_squares;
}</code></pre>
    </p>
    <?php
    // Algorithm
    function square_n_sum($nums) {
      for ($i = 0; $i < sizeof($nums); $i++) {
        $nums[$i] *= $nums[$i];
      }
      $sum_of_squares = 0;
      for ($i = 0; $i < sizeof($nums); $i++) {
        $sum_of_squares += $nums[$i];
      }
      return $sum_of_squares;
    }

    // Test
    $test1 = new Test();
    ?><h3>Expectation Tests</h3><?php
    // Trying out the ```expect()``` method
    $test1->expect(square_n_sum(array(1,2)) === 5);
    $test1->expect(square_n_sum(array(2,3)) === 13);
    $test1->expect(square_n_sum(array(3,4)) === 25, "Whoops, your algorithm did not return the expected result.  Please check your algorithm for any possible logical errors.");
    $test1->expect(square_n_sum(array(1,2,3)) === 14);
    $test1->expect(square_n_sum(array(3,4,5)) === 50, "Whoops, your algorithm did not return the expected result.  Please check your algorithm for any possible logical errors.");
    ?><h3>Equality Test (assert_equals)</h3><?php
    // Let's see how the algorithm fares if we use the ```assert_equals()``` method instead
    $test1->assert_equals(square_n_sum(array(1,2,3,4)), 30, "Whoops, your algorithm did not return the expected result.  Please check your algorithm for any possible logical errors.");
    $test1->assert_equals(square_n_sum(array(2,3,4,5)), 54);
    $test1->assert_equals(square_n_sum(array(3,4,5,6,7)), 135);
    $test1->assert_equals(square_n_sum(array(3,4,5,5)), 75, "Sorry, your algorithm did not return the correct value(s).  Maybe you squared the sum of the numbers instead of summing the square of the numbers?");
    ?><h3>Inequality Test - Making sure the algorithm does NOT return such values</h3><?php
    // The algorithm should NOT return such values
    $test1->assert_not_equals(square_n_sum(array(3,4,5,5)), 0);
    $test1->assert_not_equals(square_n_sum(array(3,4,5,5)), 72);
    $test1->assert_not_equals(square_n_sum(array(3,4,5,5)), 73);
    $test1->assert_not_equals(square_n_sum(array(3,4,5,5)), 74);
    $test1->assert_not_equals(square_n_sum(array(3,4,5,5)), 76);
    $test1->assert_not_equals(square_n_sum(array(3,4,5,5)), 77);
    $test1->assert_not_equals(square_n_sum(array(3,4,5,5)), 78);
    ?><h3>Results</h3><?php
    $test1->print_summary();
    ?>
    <h2>Test - Faulty Algorithm</h2>
    <p>
      In the case of a faulty algorithm, the algorithm may manage to pass some (or even most) tests, but ultimately it will fail in some cases.  As long as the algorithm fails in one or more instances, the algorithm will not pass.
    </p>
    <p>
      <strong><em><u>Note: It is HIGHLY recommended that you create a <code>new</code> instance of <code>Test</code> every time you test a new function/algorithm.</u></em></strong>
    </p>
    <h3>Faulty Algorithm Code</h3>
    <p>
<pre style="color:white;background-color:black;padding:10px;border-radius:3px;word-wrap:break-word;"><code>function faulty_square_n_sum($nums) {
  $sum_the_nums = 0;
  for ($i = 0; $i &lt; sizeof($nums); $i++) {
    $sum_the_nums += $nums[$i];
  }
  return $sum_the_nums ** 2; // Oops, it seems like the user has misunderstood the task and instead squared the sum of all the numbers in the array.  Let's see how many tests it will pass
}</code></pre>
    </p>
    <?php
    // Faulty Algorithm
    function faulty_square_n_sum($nums) {
      $sum_the_nums = 0;
      for ($i = 0; $i < sizeof($nums); $i++) {
        $sum_the_nums += $nums[$i];
      }
      return $sum_the_nums ** 2; // Oops, it seems like the user has misunderstood the task and instead squared the sum of all the numbers in the array.  Let's see how many tests it will pass
    }

    $test2 = new Test();
    ?><h3>Expectation Tests</h3><?php
    $test2->expect(faulty_square_n_sum(array(3,0)) === 9);
    $test2->expect(faulty_square_n_sum(array(0,5)) === 25, "Whoops, your algorithm did not pass.  Please check for any logical and/or syntax errors in your code");
    $test2->expect(faulty_square_n_sum(array(7,0)) === 49, "Whoops, your algorithm did not pass.  Please check for any logical and/or syntax errors in your code");
    // The algorithm may pass the test in special cases, but if it is faulty, ultimately, it will fail at least some tests
    $test2->expect(faulty_square_n_sum(array(3,4,5)) === 50);
    $test2->expect(faulty_square_n_sum(array(1,2,3,4,5)) === 55, "Whoops, your algorithm did not pass.  Please check for any logical and/or syntax errors in your code");
    ?><h3>Equality Test</h3><?php
    $test2->assert_equals(faulty_square_n_sum(array(3,4,5,6,7)), 135);
    $test2->assert_equals(faulty_square_n_sum(array(0,0,15,0,0)), 225);
    $test2->assert_equals(faulty_square_n_sum(array(1,3,5,7,9)), 165, "Whoops, your algorithm did not return the correct result.  Please make sure you have done your maths correctly ;)");
    $test2->assert_equals(faulty_square_n_sum(array(2,4,10,8,6)), 220);
    ?><h3>Inequality Test</h3><p>In this case, make sure that the user did not misunderstand the task and square the sum of the numbers in the array instead.</p><?php
    // Looks like the user did EXACTLY that
    $test2->assert_not_equals(faulty_square_n_sum(array(3,4,5)), 144, "Read the question again.  You were asked to sum the square of the numbers in the array; instead, you squared the sum of the numbers");
    $test2->assert_not_equals(faulty_square_n_sum(array(1,2,3)), 36);
    $test2->assert_not_equals(faulty_square_n_sum(array(1,2,3,4,5)), 225);
    $test2->assert_not_equals(faulty_square_n_sum(array(1,2,3,4,5)), 0);
    ?><h3>Test Summary</h3><?php
    $test2->print_summary();
    ?>
  </body>
</html>
