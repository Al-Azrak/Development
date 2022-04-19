<?php
namespace PHPMVC\LIB;

trait
{
    public function filterInt($input)
    {
        return filter_input($input, FILTER_SANITIZE_NUMBER_INT);
    }

    public function filterFloat($input)
    {
        return filter_input($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_ALLOW_FLAG);
    }

    public function filterString($input)
    {
        return htmlentities(strip_tags($input), ENT_QUOTES, 'UTF-8');
    }
}