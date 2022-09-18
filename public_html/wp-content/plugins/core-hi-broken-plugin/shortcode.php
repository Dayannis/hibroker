<?php

class ShortCode
{
  static function test_short_hi_broken($args)
  {
    echo "<p>Echo bien hecho!</p>";
  }
  
  static function quote_form($args)
  {
    include('contents/quote_form/view.php');
  }
}