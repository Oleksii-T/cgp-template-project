<?php

// generale unique slug based on provided array
if (!function_exists('makeSlug')) {
    function makeSlug($str, $check = [])
    {
        $slug = Str::slug($str);

        if (in_array($slug, $check)) {
            $rand = 2;
            while (true) {
                if (!in_array($slug . '-' . $rand, $check)) {
                    $slug = $slug . '-' . $rand;
                    break;
                }
                $rand++;
            }
        }

        return $slug;
    }
}

// get user avatar with fallback image
if (!function_exists('userAvatar')) {
    function userAvatar($user=null) {
        $default = asset('img/empty-avatar.jpeg');
        if (!$user) {
            return $default;
        }

        return $user->avatar ? $user->avatar : $default;
    }
}

// transform snake\kebab\camel case to user friendly string
if (!function_exists('readable')) {
    function readable(string $s, $upperCaseEach=false) {
        if (str_contains($s, '-')) {
            $s = str_replace('-', ' ', $s);// kebab case
        } else if (str_contains($s, '_')) {
            $s = str_replace('_', ' ', $s);// snake case
        } else {
            $s = strtolower(preg_replace('/(?<!^)[A-Z]/', ' $0', $s));// camel case
        }

        return $upperCaseEach ? ucwords($s) : ucfirst($s);
    }
}

// print some message to separate log file
if (!function_exists('dlog')) {
    function dlog(string $text, array $array=[]) {
        return \Log::channel('dev')->info($text, $array);
    }
}

// check is current user is dev
if (!function_exists('isdev')) {
    function isdev() {
        try {

            // developer GET parameter
            $isDev = isset($_GET['debugvoeunfnl491203u']);

            if ($isDev) {
                return true;
            }

            // developer ips
            $devs = [
                '127.0.0.1',
            ];

            if (in_array(request()->ip(), $devs)) {
                return true;
            }

            $user = auth()->user();
            if (!$user) {
                return false;
            }

            // developer users
            $devs = [
                1
            ];

            return in_array($user->id, $devs);
        } catch (\Throwable $th) {
            return false;
        }
    }
}

// get readable last json error
if (!function_exists('_json_last_error')) {
    function _json_last_error()
    {
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                return 'No errors';
            case JSON_ERROR_DEPTH:
                return 'Maximum stack depth exceeded';
            case JSON_ERROR_STATE_MISMATCH:
                return 'Underflow or the modes mismatch';
            case JSON_ERROR_CTRL_CHAR:
                return 'Unexpected control character found';
            case JSON_ERROR_SYNTAX:
                return 'Syntax error, malformed JSON';
            case JSON_ERROR_UTF8:
                return 'Malformed UTF-8 characters, possibly incorrectly encoded';
            default:
                return 'Unknown error';
        }
    }
}
