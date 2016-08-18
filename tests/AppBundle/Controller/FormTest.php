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
use Facebook\WebDriver\WebDriverBy;


class FormTest extends \PHPUnit_Framework_TestCase
{

    protected $webDriver;
    protected $url = 'localhost:8000/home';
    protected $firstName = 'John';
    protected $lastName = 'Doe';
    protected $street = '12345 Testing';
    protected $city = 'Detroit';
    protected $state = 'MI';
    protected $postal = 12345;

    public function setUp()
    {
        $capabilities = array(WebDriverCapabilityType::BROWSER_NAME=>'chrome');
        $this->webDriver = RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities);
    }


   public function tearDown()
    {
        $this->webDriver->quit();
    }

    public function testGoToHomePageAndCheckVerifyTitle()
    {
        $this->webDriver->get($this->url);
        $this->assertContains('Sign Up!', $this->webDriver->getTitle());
        $this->goToForm();
        $this->fillFormAndSubmit();
    }



    public function goToForm()
    {
        $this->webDriver->findElement(WebDriverBy::linkText('Form'))->click();
    }

    public function fillFormAndSubmit()
    {
        $form = $this->webDriver->findElement(WebDriverBy::name('new_person_form'));
        $this->webDriver->findElement(WebDriverBy::id('new_person_form_firstName'))->sendKeys('John');
        $this->webDriver->findElement(WebDriverBy::id('new_person_form_lastName'))->sendKeys('Doe');
        $this->webDriver->findElement(WebDriverBy::id('new_person_form_street'))->sendKeys('12345 Testing');
        $this->webDriver->findElement(WebDriverBy::id('new_person_form_city'))->sendKeys('Detroit');
        $this->webDriver->findElement(WebDriverBy::id('new_person_form_state'))->sendKeys('MI');
        $this->webDriver->findElement(WebDriverBy::id('new_person_form_postal'))->sendKeys('12345');
        $form->submit();
    }

    public function getDataOfLastPerson()
    {

    }



    //not used code --- must fix later------
    /*public function validPersonInput()
    {
        $input=[

                'new_person_form_firstName' => 'Saresa',
                'new_person_form_lastName'  => 'Smith',
                'new_person_form_street'    => '12345 Testing',
                'new_person_form_city'      => 'Detroit',
                'new_person_form_state'     => 'MI',
                'new_person_form_postal'    => 12345


        ];
        return $input;

        foreach ($inputs as $input => $value){
            $form->$this->byName($input)->value($value);
        }
    }*/
}