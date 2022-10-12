<?php
function validate($rule, $string)
{
    switch ($rule) {
        case 'email':
            if (strpos($string, "@") && strlen(explode("@", $string)[1] > 0)) {
                return true;
            }
            break;
        case 'password':
            $return = true;
            if (strlen($string) < 8) $return = false;
            if (!preg_match('/[a-zA-Z]/', $string)) $return = false;
            return $return;
            break;
        default:
            if (is_array($rule)) {
                foreach ($rule as $r => $v) {
                    switch ($r) {
                        case 'minSize':
                            if (strlen($string) < $v) return false;
                            break;
                        case 'maxSize':
                            if (strlen($string) > $v) return false;
                            break;
                        case 'contains':
                            if (!strpos($string, $v)) return false;
                            break;
                        case 'match':
                            if ($string != $v) return false;
                            break;
                        default:
                            return false;
                    }
                }

            }

            return true;
    }
}

?>