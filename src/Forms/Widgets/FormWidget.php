<?php
declare(strict_types=1);
namespace Forms\Widgets;
interface FormWidget
{
    public function render(): string;
}