<?php

function localizeCSS() {
    return app()->getLocale() === 'ar' ? 'css-rtl' : 'css';
}

function removeFromString(string $originalString, array $remove, string $separator, bool $trim = false, $boundWithSeparator = false) {
    $separatedStrings = explode($separator, $trim ? trim($originalString, '/') : $originalString);
    $i = 0;
    foreach ($separatedStrings as $string) {
        if(in_array($string, $remove)) {
            unset($separatedStrings[$i]);
            $i++;
        }
    }
    return $boundWithSeparator ? $separator . implode($separator, $separatedStrings) . $separator : implode($separator, $separatedStrings);
}
