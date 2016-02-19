<?php require "test_fixture/class.test.php"; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PHP Regex Test</title>
    <style media="screen">
      .test-fixture {
        background-color: black;
        color: white;
        padding: 10px;
        border-radius: 10px;
      }
    </style>
  </head>
  <body>
    <h1>PHP Regex Test</h1>
    <ol>
      <li>
        <h2>Detecting Pure Text</h2>
        <p>
          In this example, pure text is defined as containing nothing more than:
        </p>
        <ul>
          <li>Alphanumeric characters (a-z, A-Z, 0-9)</li>
          <li>Punctuation Marks (e.g. .,!?)</li>
          <li>Quotation Marks ("" and '')</li>
          <li>Newlines and Spacing (\r, \n, \s)</li>
        </ul>
        <?php
        $pure_text = '/^[a-zA-Z0-9\'\"\.\,\!\?\n\r\s]+$/';
        echo "<p><strong>Regex: $pure_text</strong></p>";
        ?>
        <div class="test-fixture">
          <h2>Test Fixture</h2>
          <?php
          $test1 = new Test;
          $test1->assert_equals(preg_match($pure_text, "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 1);
          $test1->assert_equals(preg_match($pure_text, "Hello world, this is pure text.  Does this work?  If not, I'll alter the regex."), 1);
          $test1->assert_equals(preg_match($pure_text, "This is not pure text as it <b>contains HTML tags</b>."), 0);
          $test1->assert_equals(preg_match($pure_text, "Lorem ipsum dolor sit amet, adispicing eu.\r\nHello, what's up?  Stop looking at me!  Fine, I'll leave."), 1);
          $test1->assert_equals(preg_match($pure_text, "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789>"), 0);
          $test1->assert_equals(preg_match($pure_text, "<p>Regex: /^[a-zA-Z0-9\'\"\.\,\!\?\n\r\s]+$/</p>"), 0);

          echo "<hr />";
          $test1->print_summary();
          ?>
        </div>
      </li>
      <li>
        <h2>HTML tags with Pure Text</h2>
        <p>
          The regex below tests whether the string passed in is pure text wrapped in exactly one valid HTML tag.
        </p>
        <?php
        $html_pure_text = '/^<([a-z]+|[a-z]{1}[a-z0-9]+)>[a-zA-Z0-9\s\,\.\?\!\'\"]+<\/([a-z]+|[a-z]{1}[a-z0-9]+)>$/';
        echo "<p><strong>Regex: $html_pure_text</strong></p>";
        ?>
        <div class="test-fixture">
          <h2>Test Fixture</h2>
        <?php
        $test2 = new Test;
        $test2->assert_equals(preg_match($html_pure_text, "<h2>HTML Tags with Pure Text</h2>"), 1);
        $test2->assert_equals(preg_match($html_pure_text, "<p>Lorem ipsum dolor sit amet, adispicing eu.</p>"), 1);
        $test2->assert_equals(preg_match($html_pure_text, "Lorem ipsum dolor sit amet, adispicing eu."), 0, "Test should fail because string passed in does not contain HTML tags.");
        $test2->assert_equals(preg_match($html_pure_text, "<p><strong>Should not match regex when using multiple HTML tags</strong></p>"), 0, "Test should fail because regex does not allow multiple nested HTML tags to be used");
        $test2->assert_equals(preg_match($html_pure_text, "<6>Trying to get past the regex with invalid HTML tags</6>"), 0, "Tags are invalid - test should not pass!");
        $test2->assert_equals(preg_match($html_pure_text, "<p>Tag not closed properly - should not pass"), 0);
        echo "<hr />";
        $test2->print_summary();
        ?>
        </div>
      </li>
      <li>
        <h2>Valid Email Address</h2>
        <p>
          Here is my take at creating a regular expression that validates valid email addresses.  <strong>Please note that I did not copy the regex off the Internet when I created it.</strong>
        </p>
        <?php
        $valid_email = '/^([a-zA-Z0-9_]+|[a-zA-Z0-9_]+\.[a-zA-Z0-9_]+)@([a-zA-Z0-9_]+|[a-zA-Z0-9_]+\.[a-zA-Z0-9]+)\.[a-z]+$/';
        echo "<p><strong>Regex: $valid_email</strong></p>";
        ?>
        <div class="test-fixture">
          <h2>Test Fixture</h2>
        <?php
        $test3 = new Test;
        $test3->assert_equals(preg_match($valid_email, "donald_think@hotmail.com"), 1, "donald_think@hotmail.com is a perfectly valid email address");
        $test3->assert_equals(preg_match($valid_email, "i.donaldl@me.com"), 1, "i.donaldl@me.com is a perfectly valid email address");
        $test3->assert_equals(preg_match($valid_email, "dleung@connect.kellettschool.com"), 1, "dleung@connect.kellettschool.com is a perfectly valid email address");
        $test3->assert_equals(preg_match($valid_email, "alpha_beta.gamma_delta@theta_thi.tld"), 1, "Email Address is theoretically valid");
        $test3->assert_equals(preg_match($valid_email, "donald leung@example.tld"), 0, "Email cannot contain whitespaces");
        $test3->assert_equals(preg_match($valid_email, "donald.sebastian leung@kellettschool.com"), 0, "Whitespaces not allowed");
        $test3->assert_equals(preg_match($valid_email, "donald.@hotmail.com"), 0, "'@' and '.' cannot appear consecutively");
        $test3->assert_equals(preg_match($valid_email, "donald@tld"), 0, "At least one dot must appear in valid email address");
        echo "<hr />";
        $test3->print_summary();
        ?>
        </div>
      </li>
    </ol>
  </body>
</html>
