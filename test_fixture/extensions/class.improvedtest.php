<?php
require "../class.test.php";
/*
  Since the Test Fixture is a class, you can use the "extends" keyword to inherit from the Test Fixture and create your own custom test fixture
*/
// E.g. ...
class ImprovedTest extends Test {
  public function print_summary() {
    echo ($this->passes > 0 || $this->fails > 0) ? "<p style='color:green;font-weight:bold;'>$this->passes Passed</p><p style='color:red;font-weight:bold;'>$this->fails Failed</p>" . (($this->fails === 0) ? "<p style='color:green;font-weight:bold;'>Algorithm Passed</p>" : "<p style='color:red;font-weight:bold;'>Algorithm did not pass - try again</p>") : "<p style='color:red;font-weight:bold;'>Error: No test cases provided; must provide at least 1 to validate algorithm</p>";
    // Add a return value so further actions can be performed according to outcome
    return ($this->passes > 0 && $this->fails === 0) ? true : false;
  }
}
?>
