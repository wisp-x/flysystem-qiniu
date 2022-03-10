<?php

namespace WispX\Flysystem\Upyun\Tests;

use League\Flysystem\Config;
use Mockery;
use WispX\Flysystem\Upyun\UpyunAdapter;
use PHPUnit\Framework\TestCase;

/**
 * 测试时需要逐个测试，否则会因为速度太快或并行测试时导致测试不通过
 * Class QiniuAdapterTest.
 */
class UpyunAdapterTest extends TestCase
{
    public function upyunProvider()
    {
        $adapter = Mockery::mock(UpyunAdapter::class, ['serviceName', 'operatorName', 'password', 'domain'])
            ->makePartial()
            ->shouldAllowMockingProtectedMethods();

        return [
            [$adapter],
        ];
    }

    /**
     * @dataProvider upyunProvider
     */
    public function testWrite($adapter)
    {
        $this->assertNull($adapter->write('test/one.md', file_get_contents(__DIR__ . '/test.md'), new Config()));
        $this->assertNull($adapter->write('test/中文 +.md', file_get_contents(__DIR__ . '/test.md'), new Config()));
    }

    /**
     * @dataProvider upyunProvider
     */
    public function testWriteStream($adapter)
    {
        $this->assertNull($adapter->write('test/two.md', file_get_contents(__DIR__ . '/test.md'), new Config()));
        $this->assertNull($adapter->write('test/中文 ++.md', file_get_contents(__DIR__ . '/test.md'), new Config()));
    }

    /**
     * @dataProvider upyunProvider
     */
    public function testMove($adapter)
    {
        $this->assertNull($adapter->move('test/中文 ++.md', 'test/three.md', new Config()));
    }

    /**
     * @dataProvider upyunProvider
     */
    public function testCopy($adapter)
    {
        $this->assertNull($adapter->copy('test/three.md', 'test/three-copy.md', new Config()));
    }

    /**
     * @dataProvider upyunProvider
     */
    public function testDelete($adapter)
    {
        $this->assertNull($adapter->delete('test/three-copy.md'));
    }

    /**
     * @dataProvider upyunProvider
     */
    public function testHas($adapter)
    {
        $this->assertTrue($adapter->fileExists('test/three.md'));
        $this->assertFalse($adapter->fileExists('test/three111.md'));
    }

    /**
     * @dataProvider upyunProvider
     */
    public function testRead($adapter)
    {
        $this->assertSame(file_get_contents(__DIR__.'/test.md'), $adapter->read('test/three.md'));
        $this->assertSame(file_get_contents(__DIR__.'/test.md'), $adapter->read('test/中文 +.md'));
    }

    /**
     * @dataProvider upyunProvider
     */
    public function testReadStream($adapter)
    {
        $this->assertSame(file_get_contents(__DIR__.'/test.md'), stream_get_contents($adapter->readStream('test/three.md')));
        $this->assertSame(file_get_contents(__DIR__.'/test.md'), stream_get_contents($adapter->readStream('test/中文 +.md')));
    }

    /**
     * @dataProvider upyunProvider
     */
    public function testListContents($adapter)
    {
        $res = $adapter->listContents('test', true);
        $files = ['test/one.md', 'test/two.md', 'test/three.md', 'test/中文 +.md'];
        foreach ($res as $item) {
            if (! in_array($item->path(), $files)) {
                $this->fail();
            }
        }
        $this->assertTrue(true);
    }

    /**
     * @dataProvider upyunProvider
     */
    public function testGetSize($adapter)
    {
        $this->assertSame(filesize(__DIR__.'/test.md'), $adapter->fileSize('test/three.md')->fileSize());
    }
}
