<?php
/**
 * Created by PhpStorm.
 * User: saresa
 * Date: 17/08/16
 * Time: 9:46 AM
 */

namespace Tests\AppBundle\Controller;


use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\WebDriverCapabilityType;
use Facebook\WebDriver\WebDriverCapabilities;

class GitHubTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Facebook\WebDriver\WebDriverBy
     */
    protected $webDriver;

    public function setUp()
    {
        $capabilities = array(WebDriverCapabilityType::BROWSER_NAME=>'firefox');
        $this->webDriver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities);
    }

    public function tearDown()
    {
        $this->webDriver->quit();
    }

    protected $url = 'https://github.com';

    public function testGitHubHome()
    {
        $this->webDriver->get($this->url);
        // checking that page title contains word 'GitHub'
        $this->assertContains('GitHub', $this->webDriver->getTitle());
    }

}