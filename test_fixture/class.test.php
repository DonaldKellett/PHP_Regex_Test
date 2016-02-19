<?php
class Test {
  public $passes = 0;
  public $fails = 0;
  public function expect($expression, $msg = "Test Failed - Algorithm did not return expected results") {
    echo ($expression === true) ? "<p style='color:green;font-weight:bold;'>Test Passed</p>" : "<p style='color:red;font-weight:bold;'>$msg</p>";
    if ($expression === true) {
      $this->passes++;
    } else {
      $this->fails++;
    }
  }
  public function assert_equals($actual, $expected, $msg = "Test Failed: Actual Value did not match Expected") {
    echo ($actual === $expected) ? "<p style='color:green;font-weight:bold;'>Test Passed</p>" : "<p style='color:red;font-weight:bold;'>$msg => Expected: " . htmlspecialchars_decode("&quot;") . $expected . htmlspecialchars_decode("&quot;") . " but instead got: " . htmlspecialchars_decode("&quot;") . $actual . htmlspecialchars_decode("&quot;") . "</p>";
    if ($actual === $expected) {
      $this->passes++;
    } else {
      $this->fails++;
    }
  }
  public function assert_not_equals($actual, $expect_NOT, $msg = "Test Failed: Algorithm should NOT return tested value") {
    echo ($actual != $expect_NOT) ? "<p style='color:green;font-weight:bold;'>Test Passed</p>" : "<p style='color:red;font-weight:bold;'>$msg => Algorithm returned value: " . htmlspecialchars_decode("&quot;") . $actual . htmlspecialchars_decode("&quot;") . "</p>";
    if ($actual != $expect_NOT) {
      $this->passes++;
    } else {
      $this->fails++;
    }
  }
  public function print_summary() {
    echo ($this->passes > 0 || $this->fails > 0) ? "<p style='color:green;font-weight:bold;'>$this->passes Passed</p><p style='color:red;font-weight:bold;'>$this->fails Failed</p>" . (($this->fails === 0) ? "<p style='color:green;font-weight:bold;'>Algorithm Passed</p>" : "<p style='color:red;font-weight:bold;'>Algorithm did not pass - try again</p>") : "<p style='color:red;font-weight:bold;'>Error: No test cases provided; must provide at least 1 to validate algorithm</p>";
  }
}
?>
