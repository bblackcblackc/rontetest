<?php
/**
 * Test class for SortDataProcessorClass
 */

class SortDataProcessorClassTest extends PHPUnit\Framework\TestCase
{
    /**
     * @var $instance Class instance
     */
    protected $instance;

    protected function setUp()
    {
        $params = [
            'fields' => [
                'name' => 'asc',
                'url' => 'desc'
            ]
        ];

        $this->instance = new SortDataProcessorClass($params);
    }

    protected function tearDown()
    {
        unset($this->instance);
    }

    // Test data
    const TestArray1    = [
        [
            'name' => 'name1',
            'key' => 'key1'
        ],
        [
            'name' => 'name2',
            'key' => 'key2'
        ],
        [
            'name' => 'name2',
            'key' => 'key3'
        ],
        [
            'name' => 'name2',
            'key' => 'key1'
        ],
        [
            'name' => 'name3',
            'key' => 'key3'
        ],
    ];

    /**
     * @dataProvider providerProcessData
     */
    public function testProcessData($param0,$param1) {

        print_r($this->instance->processData($param1));

//        $this->assertNotEquals(
//            $param0,
//            json_encode($this->instance->processData($param1)) == json_encode($param1)
//        );
    }

    public function providerProcessData() {
        return [
            [ true, self::TestArray1 ]
        ];
    }
}