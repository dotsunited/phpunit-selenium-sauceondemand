This repository is NOT maintained anymore!
==========================================

PHPUnit_Selenium_SauceOnDemand development has been moved to the official Saucelabs repository: 

<https://github.com/saucelabs/phpunit-selenium-sauceondemand>

PHPUnit_Selenium_SauceOnDemand
==============================

[Sauce OnDemand](http://saucelabs.com) integration for [PHPUnit](http://www.phpunit.de).

This package extends the [PHPUnit_Selenium](https://github.com/sebastianbergmann/phpunit-selenium) extension and provides additional setter functions for [Sauce OnDemand specific options](https://saucelabs.com/products/docs/sauce-ondemand).

Additional setters are:

    public function setUsername($username);
    public function setAccessKey($accessKey);
    public function setOs($os);
    public function setBrowserVersion($browserVersion);
    public function setJobName($jobName);
    public function setPublic($public);
    public function setTags($tags);
    public function setPassed($passed);
    public function setRecordVideo($recordVideo);
    public function setRecordScreenshots($recordScreenshots);
    public function setSauceAdvisor($sauceAdvisor);
    public function setSingleWindow($singleWindow);
    public function setUserExtensionsUrl($userExtensionsUrl);
    public function setFirefoxProfileUrl($firefoxProfileUrl);
    public function setMaxDuration($maxDuration);
    public function setIdleTimeout($idleTimeout);
    public function setBuild($build);
    public function setCustomData($customData);

[Multiple browser configurations](http://www.phpunit.de/manual/3.5/en/selenium.html#selenium.seleniumtestcase.examples.WebTest3.php) are also possible:

    class WebTest extends PHPUnit_Extensions_SeleniumTestCase_SauceOnDemandTestCase
    {
        public static $browsers = array(
            array(
                'name'           => 'Firefox 3.6 on Windows',
                'username'       => 'your-saucelabs-username',
                'accessKey'      => 'your-saucelabs-access-key',
                'os'             => 'Windows 2003',
                'browser'        => 'firefox',
                'browserVersion' => '3.6.'
            ),
            array(
                'name'           => 'Google Chrome on Windows',
                'username'       => 'your-saucelabs-username',
                'accessKey'      => 'your-saucelabs-access-key',
                'os'             => 'Windows 2003',
                'browser'        => 'googlechrome',
                'browserVersion' => ''
            ),
            array(
                'name'           => 'Internet Explorer 8 on Windows',
                'username'       => 'your-saucelabs-username',
                'accessKey'      => 'your-saucelabs-access-key',
                'os'             => 'Windows 2003',
                'browser'        => 'iexplore',
                'browserVersion' => '8.'
            )
        );
    }

## Installation ##

You can install PHPUnit_Selenium_SauceOnDemand via the [Dots United PEAR channel](http://pear.dotsunited.de). Run this from your command line:

    pear channel-discover pear.dotsunited.de
    pear install dotsunited/PHPUnit_Selenium_SauceOnDemand

The above process will install PHPUnit_Selenium_SauceOnDemand as a PEAR library.
