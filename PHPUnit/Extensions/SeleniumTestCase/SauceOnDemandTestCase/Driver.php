<?php
/**
 * PHPUnit
 *
 * Copyright (c) 2002-2010, Sebastian Bergmann <sb@sebastian-bergmann.de>.
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
 * @copyright  2002-2010 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link       http://www.phpunit.de/
 * @since      File available since Release 3.5.0
 */

require_once 'PHPUnit/Extensions/SeleniumTestCase/Driver.php';

/**
 * Implementation of the Sauce OnDemand protocol.
 *
 * @package    PHPUnit_Selenium
 * @author     Jan Sorgalla <jan.sorgalla@dotsunited.de>
 * @copyright  2002-2010 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://www.phpunit.de/
 * @since      Class available since Release 3.5.0
 */
class PHPUnit_Extensions_SeleniumTestCase_SauceOnDemandTestCase_Driver extends PHPUnit_Extensions_SeleniumTestCase_Driver
{
    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $accessKey;

    /**
     * @var string
     */
    protected $os;

    /**
     * @var string
     */
    protected $browserVersion;

    /**
     * @var string
     */
    protected $jobName;

    /**
     * @var boolean
     */
    protected $public;

    /**
     * @var array
     */
    protected $tags;

    /**
     * @var boolean
     */
    protected $passed;

    /**
     * @var boolean
     */
    protected $recordVideo;

    /**
     * @var boolean
     */
    protected $recordScreenshots;

    /**
     * @var boolean
     */
    protected $sauceAdvisor;

    /**
     * @var boolean
     */
    protected $singleWindow;

    /**
     * @var string|array
     */
    protected $userExtensionsUrl;

    /**
     * @var string
     */
    protected $firefoxProfileUrl;

    /**
     * @var integer
     */
    protected $maxDuration;

    /**
     * @var integer
     */
    protected $idleTimeout;

    /**
     * @var integer
     */
    protected $build;

    /**
     * @var object
     */
    protected $customData;

    /**
     * @throws RuntimeException
     */
    public function __construct()
    {
        if (!extension_loaded('json')) {
            throw new RuntimeException('ext/json is not available');
        }

        parent::__construct();
    }

    /**
     * @return string
     */
    public function start()
    {
        if ($this->browserUrl == NULL) {
            throw new PHPUnit_Framework_Exception(
              'setBrowserUrl() needs to be called before start().'
            );
        }

        if ($this->username === NULL) {
            throw new PHPUnit_Framework_Exception(
              'setUsername() needs to be called before start().'
            );
        }

        if ($this->accessKey === NULL) {
            throw new PHPUnit_Framework_Exception(
              'setAccessKey() needs to be called before start().'
            );
        }

        if ($this->os === NULL) {
            throw new PHPUnit_Framework_Exception(
              'setOs() needs to be called before start().'
            );
        }

        if ($this->browser === NULL) {
            throw new PHPUnit_Framework_Exception(
              'setBrowser() needs to be called before start().'
            );
        }

        if ($this->browserVersion === NULL) {
            throw new PHPUnit_Framework_Exception(
              'setBrowserVersion() needs to be called before start().'
            );
        }

        $data = array(
            'username'        => $this->username,
            'access-key'      => $this->accessKey,
            'os'              => $this->os,
            'browser'         => $this->browser,
            'browser-version' => $this->browserVersion,
        );

        if ($this->jobName !== NULL) { // backwards compatibility
            $data['name'] = $this->jobName;
        } elseif ($this->name !== NULL) {
            $data['name'] = $this->name;
        }

        if (!isset($data['name']) || $data['name'] === '') {
            $data['name'] = $this->testCase->toString();
        }

        if ($this->public !== NULL) {
            $data['public'] = $this->public;
        }

        if ($this->tags !== NULL) {
            $data['tags'] = $this->tags;
        }

        if ($this->passed !== NULL) {
            $data['passed'] = $this->passed;
        }

        if ($this->recordVideo !== NULL) {
            $data['record-video'] = $this->recordVideo;
        }

        if ($this->recordScreenshots !== NULL) {
            $data['record-screenshots'] = $this->recordScreenshots;
        }

        if ($this->sauceAdvisor !== NULL) {
            $data['sauce-advisor'] = $this->sauceAdvisor;
        }

        if ($this->singleWindow !== NULL) {
            $data['single-window'] = $this->singleWindow;
        }

        if ($this->userExtensionsUrl !== NULL) {
            $data['user-extensions-url'] = $this->userExtensionsUrl;
        }

        if ($this->firefoxProfileUrl !== NULL) {
            $data['firefox-profile-url'] = $this->firefoxProfileUrl;
        }

        if ($this->maxDuration !== NULL) {
            $data['max-duration'] = $this->maxDuration;
        }

        if ($this->idleTimeout !== NULL) {
            $data['idle-timeout'] = $this->idleTimeout;
        }

        if ($this->build !== NULL) {
            $data['build'] = $this->build;
        }

        if ($this->customData !== NULL) {
            $data['custom-data'] = $this->customData;
        }

        if (!isset($this->sessionId)) {
            $this->sessionId = $this->getString(
              'getNewBrowserSession',
              array(json_encode($data), $this->browserUrl)
            );

            $this->doCommand('setTimeout', array($this->seleniumTimeout * 1000));
        }

        return $this->sessionId;
    }

    /**
     * @param  string $username
     * @throws InvalidArgumentException
     */
    public function setUsername($username)
    {
        if (!is_string($username)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->username = $username;
    }

    /**
     * @param  string $accessKey
     * @throws InvalidArgumentException
     */
    public function setAccessKey($accessKey)
    {
        if (!is_string($accessKey)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->accessKey = $accessKey;
    }

    /**
     * @param  string $os
     * @throws InvalidArgumentException
     */
    public function setOs($os)
    {
        if (!is_string($os)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->os = $os;
    }

    /**
     * @param  string $browserVersion
     * @throws InvalidArgumentException
     */
    public function setBrowserVersion($browserVersion)
    {
        if (!is_string($browserVersion)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->browserVersion = $browserVersion;
    }

    /**
     * @param  string $jobName
     * @throws InvalidArgumentException
     */
    public function setJobName($jobName)
    {
        if (!is_string($jobName)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->jobName = $jobName;
    }

    /**
     * @param  boolean $public
     * @throws InvalidArgumentException
     */
    public function setPublic($public)
    {
        if (!is_bool($public)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->public = $public;
    }

    /**
     * @param  array $tags
     * @throws InvalidArgumentException
     */
    public function setTags($tags)
    {
        if (!is_array($tags)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'array');
        }

        $this->tags = $tags;
    }

    /**
     * @param  boolean $passed
     * @throws InvalidArgumentException
     */
    public function setPassed($passed)
    {
        if (!is_bool($passed)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->passed = $passed;
    }

    /**
     * @param  boolean $recordVideo
     * @throws InvalidArgumentException
     */
    public function setRecordVideo($recordVideo)
    {
        if (!is_bool($recordVideo)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->recordVideo = $recordVideo;
    }

    /**
     * @param  boolean $recordScreenshots
     * @throws InvalidArgumentException
     */
    public function setRecordScreenshots($recordScreenshots)
    {
        if (!is_bool($recordScreenshots)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->recordScreenshots = $recordScreenshots;
    }

    /**
     * @param  boolean $sauceAdvisor
     * @throws InvalidArgumentException
     */
    public function setSauceAdvisor($sauceAdvisor)
    {
        if (!is_bool($sauceAdvisor)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->sauceAdvisor = $sauceAdvisor;
    }

    /**
     * @param  boolean $singleWindow
     * @throws InvalidArgumentException
     */
    public function setSingleWindow($singleWindow)
    {
        if (!is_bool($singleWindow)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'boolean');
        }

        $this->singleWindow = $singleWindow;
    }

    /**
     * @param  string|array $userExtensionsUrl
     * @throws InvalidArgumentException
     */
    public function setUserExtensionsUrl($userExtensionsUrl)
    {
        if (!is_string($userExtensionsUrl) && !is_array($userExtensionsUrl)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string|array');
        }

        $this->userExtensionsUrl = $userExtensionsUrl;
    }

    /**
     * @param  string $firefoxProfileUrl
     * @throws InvalidArgumentException
     */
    public function setFirefoxProfileUrl($firefoxProfileUrl)
    {
        if (!is_string($firefoxProfileUrl)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'string');
        }

        $this->firefoxProfileUrl = $firefoxProfileUrl;
    }

    /**
     * @param  integer $maxDuration
     * @throws InvalidArgumentException
     */
    public function setMaxDuration($maxDuration)
    {
        if (!is_integer($maxDuration)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'integer');
        }

        $this->maxDuration = $maxDuration;
    }

    /**
     * @param  integer $idleTimeout
     * @throws InvalidArgumentException
     */
    public function setIdleTimeout($idleTimeout)
    {
        if (!is_integer($idleTimeout)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'integer');
        }

        $this->idleTimeout = $idleTimeout;
    }

    /**
     * @param  integer $build
     * @throws InvalidArgumentException
     */
    public function setBuild($build)
    {
        if (!is_integer($build)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'integer');
        }

        $this->build = $build;
    }

    /**
     * @param  object $customData
     * @throws InvalidArgumentException
     */
    public function setCustomData($customData)
    {
        if (is_array($customData)) {
            $customData = (object) $customData;
        }

        if (!is_object($customData)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(1, 'object');
        }

        $this->customData = $customData;
    }
}
