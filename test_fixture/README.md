# PHP Test Fixture

## Overview

This is my very first attempt at using object-oriented programming (OOP) in PHP to (try to) create something (vaguely) useful.  For this reason, I sincerely apologise if this mini-project is below standard.

In this mini project, I also started using the ternary operator (```(condition) ? true_value : false_value;```) in ```echo```, ```return``` and variable assignment statements instead of the usual if/else statements.  Once I understood how the ternary operator behaved and how to use multiple such operators in a single statement, my code looked much more clean and concise (at least in my opinion) - if/else statements that usually took almost ten lines of code were reduced to a single line of code.

This PHP test fixture is designed for testing algorithms and complex functions (in PHP, obviously).  For example, if you have created your own filter (like the built in ```filter_var($str, FILTER_SANITIZE_STRING);``` for example) and would like to make sure that your filter is working properly and returning the correct output, you could use this test fixture to confirm that it is working properly.

## Usage

In order to use this PHP Test Fixture (Algorithm Tester), you will have to first ```require``` the ```class.test.php``` file.

```php
require "/path/to/your/class.test.php";
```

Then, to start using it, just create a new instance of ```Test```.  *As of 06/02/16, the test fixture has no ```__construct()``` function/method so you cannot configure the tester upon initialisation.*

```php
$test = new Test();
```

Once your test fixture is initialised, there are three methods you can use to test your function or algorithm.  You can use them for an unlimited number of times and for an unlimited number of cases.  **Note that the test fixture can only be used to test ```return``` values so for example it cannot test whether the ```echo``` statements in your function has worked.**

```php
$test->expect($boolean[, $optional_msg_upon_failure]);
$test->assert_equals($actual, $expected[, $optional_msg_upon_failure]);
$test->assert_not_equals($actual, $expected[, $optional_msg_upon_failure]);
```

In the ```assert_equals()``` and ```assert_not_equals()``` methods, please note that although value comparison works in both directions, **the order of the actual and expected values *does matter***.  This is because if the test is passed, no difference in behaviour is observed, but *if the test does not pass*, the resulting error message becomes very confusing.  In the case of a fail, the test fixture returns the following error: ```Expected: "correct_result", but instead got: "actual_result"```.  If the arguments are swapped and there is an error, the error message will say that your (incorrect) result is the one the fixture expected but the (actual) correct result is what it got.  This would hamper your ability (or the ability of the user) to debug your code which would defeat the very purpose of using this framework to test your algorithms.  In fact, if the arguments are swapped and a confusing error message occurs, you're probably better off not using this fixture.

When the test is complete you can ask the test fixture to print a summary of the tests by calling the following method.

```php
$test->print_summary();
```

This will print something like:

<p style="color:green;font-weight:bold;">18 Passed</p>
<p style="color:red;font-weight:bold;">2 Failed</p>
<p style="color:red;font-weight:bold;">Algorithm did not pass - try again</p>

*Note: The ```print_summary()``` method returns no value - it just ```echo```es the result onto the page.*

If your algorithm passes all of the tests you have devised, the final line at the bottom will read, "Algorithm Passed".  If there is 1 single failure in any of the tests you have devised, the test fixture will say that your algorithm has failed (as above).  If you do not provide any test cases before printing the summary, the test fixture will simply return an error.

**It is highly recommended to create a new instance of ```Test``` every time you test a new function/algorithm.  This way, there is no ambiguity as to which algorithm(s) passed and which algorithm(s) failed and which pass/fail belongs to which algorithm.**

## Customisation

Since the ```Test``` class does not contain a ```__construct``` method, you cannot define any settings of the test fixture during initialisation.  For this reason, if you want to customise the behaviour of your own test fixture for your own purposes, it is highly recommended to create your own Test class (e.g. ```ImprovedTest```, see the ```extensions/``` folder) that inherits from the original ```Test``` class and add your own methods or redefine some of the built-in methods.

For example, the ```print_summary()``` method in the original ```Test``` class has no return value - it just ```echo```es the results onto your page.  In some cases, this may be rather inconvenient as you may want to add your own message(s) or HTML on top of the summary report depending on whether the algorithm has passed the test, which is made impossible by the lack of a return value.  If you go to the ```extensions/``` directory and open ```class.improvedtest.php```, you will see the ```print_summary()``` method redefined as follows:

```php
public function print_summary() {
  echo ($this->passes > 0 || $this->fails > 0) ? "<p style='color:green;font-weight:bold;'>$this->passes Passed</p><p style='color:red;font-weight:bold;'>$this->fails Failed</p>" . (($this->fails === 0) ? "<p style='color:green;font-weight:bold;'>Algorithm Passed</p>" : "<p style='color:red;font-weight:bold;'>Algorithm did not pass - try again</p>") : "<p style='color:red;font-weight:bold;'>Error: No test cases provided; must provide at least 1 to validate algorithm</p>";
  // Add a return value so further actions can be performed according to outcome
  return ($this->passes > 0 && $this->fails === 0) ? true : false;
}
```

By adding a conditional return value at the end of the function, the return value can first be stored in a variable:

```php
$algorithm_passed = $test->print_summary();
```

Then, the value of the variable can be checked in a conditional statement and you can ```echo``` the corresponding output depending on whether the algorithm has passed or not.

## Contribution

Of course, if you want to customise the Test Fixture, the more obvious solution would be to edit the ```Test``` class directly.  If you think you have made a significant improvement to my Test Fixture by doing so, feel free to create an issue or pull request.  Once I test it out and approve it, I will use your version (or a variant thereof) in this official repository.

## License

No License.  This project is Open Source.  This project can also be found at Codewars as a Kumite.

## Credits

Credits to [Codewars](http://codewars.com) for inspiring me to create this PHP Test Fixture.  I really hope PHP Kata will be supported by Codewars soon :)
