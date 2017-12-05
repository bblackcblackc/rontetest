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
                'name' => SORT_DESC_ORDER,
                'key' => SORT_ASC_ORDER
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

    const TestArray1Ok  = [
        [
            'name' => 'name3',
            'key' => 'key3'
        ],
        [
            'name' => 'name2',
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
            'name' => 'name1',
            'key' => 'key1'
        ],
    ];

    /**
     * @dataProvider providerProcessData
     */
    public function testProcessData($param0,$param1) {

        $this->assertEquals(
            $param0,
            json_encode($this->instance->processData($param1)) == json_encode(self::TestArray1Ok)
        );
    }

    public function providerProcessData() {
        return [
            [ true, self::TestArray1 ]
        ];
    }
}