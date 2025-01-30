<?php


if (!function_exists('parseMarkdown')) {
    function parseMarkdown($content)
    {
        $parsedown = new Parsedown();
        return $parsedown->text($content);
    }
}