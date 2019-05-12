<?php
use PHPUnit\Framework\TestCase;

class indexTest extends TestCase
{
    public function testEmpty()
    {
        $stack = [];
        $this->assertEmpty($stack);
    }
}
