PHPUnit_Selenium_SauceOnDemand
=============================

[Sauce OnDemand](http://saucelabs.com) integration for [PHPUnit](http://www.phpunit.de).

This package extends the [PHPUnit_Selenium](http://github.com/sebastianbergmann/phpunit-selenium) extension and provides additional setter functions for [Sauce OnDemand specific options](https://saucelabs.com/products/docs/sauce-ondemand).

Additional setters are:

    public function setUsername($username);
    public function setAccessKey($accessKey);
    public function setOs($os);
    public function setBrowserVersion($browserVersion);
    public function setJobName($jobName);
    public function setRecordVideo($recordVideo);
    public function setUserExtensionsUrl($userExtensionsUrl);
    public function setFirefoxProfileUrl($firefoxProfileUrl);
    public function setMaxDuration($maxDuration);
    public function setIdleTimeout($idleTimeout);

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
            /*array(
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
            ),*/
        );
    }

## Installation ##

The preferred installation method is via PEAR. At present no PEAR channel has been provided but this does not prevent a simple install! The simplest method of installation is:

    git clone git://github.com/dotsunited/phpunit-selenium-sauceondemand.git phpunit-selenium-sauceondemand
    cd phpunit-selenium-sauceondemand
    sudo pear install package.xml

The above process will install PHPUnit_Selenium_SauceOnDemand as a PEAR library.

Note: If installing from a git clone, you may need to delete any previous PHPUnit_Selenium_SauceOnDemand install via PEAR using:

    sudo pear uninstall PHPUnit_Selenium_SauceOnDemand