<?php
declare(strict_types=1);
namespace Forms;
interface Form
{
    public function render(): string;
}