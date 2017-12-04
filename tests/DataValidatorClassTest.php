<?php
/**
 * Test class for DataValidatorClass
 */

class DataValidatorClassTest extends PHPUnit\Framework\TestCase
{

    /**
     * @var $instance Class instance
     */
    protected $instance;

    protected function setUp()
    {
        $this->instance = new DataValidatorClass();
    }

    protected function tearDown()
    {
        unset($this->instance);
    }

    /**
     * @dataProvider providerValidateString
     */
    public function testActionValidateString($param0, $param1, $param2) {
        $this->assertEquals($param0,
                    $this->instance->actionValidateString($param1, $param2)
                    );
    }

    public function providerValidateString() {
        return [
            // positive
            [ true, 'test', [ 'required' => true ]],
            [ true, '', []],
            [ true, 'test тест', [ 'required' => true ]],
            [ true, 'test 測試', [ 'required' => true ]],

            // negative
            [ false, '', [ 'required' => true ]],
        ];
    }

    /**
     * @dataProvider providerValidateURL
     */
    public function testActionValidateURL($param0, $param1, $param2) {
        $this->assertEquals($param0,
            $this->instance->actionValidateURL($param1, $param2)
        );
    }

    public function providerValidateURL() {
        return [
            // positive
            [ true, 'http://www.ru', [ 'required' => true ]],
            [ true, 'https://www.ru', [ 'required' => true ]],
            [ true, 'www.ru', [ 'required' => true ]],
            [ true, '', []],
            [ true, 'www.ru?query=233&lalala=ololo', [ 'required' => true ]],

            // negative
            [ false, '', [ 'required' => true ]],
            [ false, 'кек', [ 'required' => true ]],
            [ false, 'ftp://1688.com/', [ 'required' => true ]],
            [ false, 'eder://www.ru', [ 'required' => true ]],
            [ false, 'mailto://1688.com/?q=測試', [ 'required' => true ]],
        ];
    }

    /**
     * @dataProvider providerValidateInt
     */
    public function testActionValidateInt($param0, $param1, $param2) {
        $this->assertEquals($param0,
            $this->instance->actionValidateInt($param1, $param2)
        );
    }

    public function providerValidateInt() {
        return [
            // positive
            [ true, 3, [ 'required' => true ]],
            [ true, -3333, [ 'required' => true ]],
            [ true, PHP_INT_MAX, [ 'required' => true ]],
            [ true, 0, []],
            [ true, 1, [ 'required' => true, 'range' => [ 'min' => 0, 'max' => 5 ] ]],
            [ true, 1, [ 'range' => [ 'min' => 0, 'max' => 5 ] ]],
            [ true, 444, [ 'required' => true, 'range' => [ 'min' => 400, 'max' => 1000 ] ]],

            // negative
            [ false, 0, [ 'required' => true ]],
            [ false, 11, [ 'required' => true, 'range' => [ 'min' => 0, 'max' => 5 ] ]],
            [ false, 15, [ 'range' => [ 'min' => 0, 'max' => 9 ], 'required' => false ]],
        ];
    }
}