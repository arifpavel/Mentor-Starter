<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Brain\Monkey;

/**
 * BaseTestCase.
 * BaseTestCase class to extend Phpunit TestCase & add brain monkey
 * @author	Arif Pavel
 * @since	v0.0.1
 * @version	v1.0.0	Friday, May 8th, 2020.
 * @global
 */
class BaseTestCase extends TestCase
{
    /**
     * setUp
     * setUp function overide
     * @author	Arif Pavel
     * @since	v0.0.1
     * @version	v1.0.0	Sunday, May 10th, 2020.
     * @access	public
     * @return	void
     */
    protected function setUp(): void
    {
        parent::setUp();
        Monkey\setUp();
    }

    /**
     * tearDow
     * tearDown function overide
     * @author	Arif Pavel
     * @since	v0.0.1
     * @version	v1.0.0	Sunday, May 10th, 2020.
     * @access	public
     * @return	void
     */
    protected function tearDown(): void
    {
        Monkey\tearDown();
        parent::tearDown();
    }
}
