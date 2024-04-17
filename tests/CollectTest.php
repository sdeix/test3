<?php

use PHPUnit\Framework\TestCase;

class CollectTest extends TestCase {

    public function testCount() {
        $collect = new \Collect\Collect([13, 17]);
        $this->assertSame(2, $collect->count());
    }

    public function testKeysWithEmptyArray() {
        $collect = new \Collect\Collect([]); 
        $this->assertEquals([], $collect->keys()->toArray());
    }

    public function testKeysWithArray() {
        $data = ['a' => 1, 'b' => 2, 'c' => 3];
        $collect = new \Collect\Collect($data);
        $this->assertEquals(['a', 'b', 'c'], $collect->keys()->toArray());
    }

    public function testValuesWithEmptyArray() {
        $collect = new \Collect\Collect([]); 
        $this->assertEquals([], $collect->values()->toArray());
    }

    public function testValuesWithArray() {
        $data = ['a' => 1, 'b' => 2, 'c' => 3];
        $collect = new \Collect\Collect($data); 
        $this->assertEquals([1, 2, 3], $collect->values()->toArray());
    }

    public function testGetWithExistingKey() {
        $data = ['a' => 1, 'b' => 2, 'c' => 3];
        $collect = new \Collect\Collect($data); 
        $this->assertEquals(2, $collect->get('b'));
    }

    
    public function testExceptWithSingleElement() {
        $data = ['a' => 1, 'b' => 2, 'c' => 3];
        $collect = new \Collect\Collect($data);
        $result = $collect->except('b');
        $this->assertEquals(['a' => 1, 'c' => 3], $result->toArray());
    }

    public function testExceptWithMultipleElements() {
        $data = ['a' => 1, 'b' => 2, 'c' => 3];
        $collect = new \Collect\Collect($data); 
        $result = $collect->except('a', 'c');
        $this->assertEquals(['b' => 2], $result->toArray());
    }
  
   

    //негативы
    public function testGetWithNonExistingKeyReturnsArray() {
        $data = ['a' => 1, 'b' => 2, 'c' => 3];
        $collect = new \Collect\Collect($data);
        
        $result = $collect->get('nonexistent_key');
        
        $this->assertIsArray($result);
        $this->assertEquals($data, $result);
    }

    public function testGetMethodWithEmptyKey(){
    $data = ['a' => 1, 'b' => 2, 'c' => 3];
    $collect = new \Collect\Collect($data);
    $value = $collect->get('');
    $this->assertEquals($data, $value);
}

public function testGetMethodWithEmptyCollection()
{
    $emptyCollect = new Collect\Collect([]);
    $value = $emptyCollect->get('a');
    $this->assertEquals([], $value);
}
public function testInvalidMapCallback()
    {
        $data = ['a' => 1, 'b' => 2, 'c' => 3];
        $collect = new \Collect\Collect($data);
        $this->expectException(\TypeError::class);
        $collect->map('invalid_callback');
    }

}