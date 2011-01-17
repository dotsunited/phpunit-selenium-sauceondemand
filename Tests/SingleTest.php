<?php
/**
 * PHPUnit
 *
 * Copyright (c) 2010-2011, Sebastian Bergmann <sb@sebastian-bergmann.de>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Sebastian Bergmann nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    PHPUnit_Selenium
 * @author     Jan Sorgalla <jan.sorgalla@dotsunited.de>
 * @copyright  2010-2011 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link       http://www.phpunit.de/
 * @since      File available since Release 3.5.0
 */

require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

/**
 * Tests for PHPUnit_Extensions_SeleniumTestCase_SauceOnDemandTestCase.
 *
 * @package    PHPUnit_Selenium
 * @author     Jan Sorgalla <jan.sorgalla@dotsunited.de>
 * @copyright  2010-2011 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://www.phpunit.de/
 * @since      Class available since Release 3.5.0
 */
class SingleTest extends PHPUnit_Extensions_SeleniumTestCase_SauceOnDemandTestCase
{
    public function setUp()
    {
        $this->setUsername(PHPUNIT_TESTSUITE_EXTENSION_SELENIUM_SAUCEONDEMAND_USERNAME);
        $this->setAccessKey(PHPUNIT_TESTSUITE_EXTENSION_SELENIUM_SAUCEONDEMAND_ACCESSKEY);
        $this->setOs('Windows 2003');
        $this->setBrowser('firefox');
        $this->setBrowserVersion('3.6.');
        $this->setPublic(false);
        $this->setTags(array('windows', 'firefox'));
        //$this->setRecordVideo(false);
        //$this->setRecordScreenshots(false);
        //$this->setSauceAdvisor(false);
        //$this->setSingleWindow(true);
        //$this->setUserExtensionsUrl('http://saucelabs.com/ext/flex.js');
        //$this->setFirefoxProfileUrl('http://saucelabs.com/example_files/rce.zip');
        $this->setMaxDuration(300);
        $this->setIdleTimeout(60);
        $this->setBuild(3);
        $this->setCustomData(array('release' => '1.0'));

        $this->setBrowserUrl('http://saucelabs.com');
    }

    public function testSauce()
    {
        $this->open('/');
        $this->assertTitle('Cross browser testing with Selenium - Sauce Labs');
    }

    /**
     * @group fail
     */
    public function testFail()
    {
        $this->open('/');
        $this->assertTitle('This should fail');
    }
}
