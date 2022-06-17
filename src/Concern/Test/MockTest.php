<?php


trait MockTest
{
    public function tearDown(): void
    {
        \Mockery::close();
    }
}