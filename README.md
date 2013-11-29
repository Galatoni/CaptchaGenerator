CaptchaGenerator
================

Font 'Helve Cursive' by toto (http://www.dafont.com/helve-cursive.font)

A simple PHP class for the production of a captcha. Example available.

This is my first attempt at a library, so go easy on me!

I've tried to make this as simple as possible. I'm aware there may be
a problem with very high volume servers using this, but this is
generally marginal as the server load would need to be colossal!

This class does require write access to the hosts /tmp/ directory
to write the captcha image. Only a single image is created
'captcha.png' which is overwrited on subsequent requests.

Some basic testing is present (as much as you can for an image!)

Basic Usage:

<?php
$obj = new CaptchaGenerator(); //Creates object, default parameters

$obj->saveCanvas(); //Saves captcha image to /tmp/

$obj->getSolution(); //returns solution to captcha

?>

Making use of $_SESSION variable to store solution and comparing
with input.
By making use of the $_SESSION variable, the solution can be stored
for later comparison.

Creating a new Captcha OVERWRITES the existing one and changes
the solution.

See example (index.php) for basic usage.

Default parameters for constructor are:
__construct($length = 8. $difficulty = 10)

Length should be between 1 and 8
Difficulty should be between 1 and 10

Any suggestions regarding improvements please contact me.

