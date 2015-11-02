<?php
class Bodhi_Form_Validation extends CI_Form_validation {
function alpha_space($str)
{
return ( ! preg_match("/^([a-z ])+$/i", $str)) ? FALSE : TRUE;
}
}