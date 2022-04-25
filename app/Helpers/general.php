<?php

function localizeCSS() {
    return app()->getLocale() === 'ar' ? 'css-rtl' : 'css';
}
