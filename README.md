Flysystem Adapter for Qiniu Cloud Storage
---

:floppy_disk: Flysystem adapter for the Qiniu cloud storage.

[![Build Status](https://travis-ci.org/overtrue/flysystem-qiniu.svg?branch=master)](https://travis-ci.org/overtrue/flysystem-qiniu) 
[![Latest Stable Version](https://poser.pugx.org/overtrue/flysystem-qiniu/v/stable.svg)](https://packagist.org/packages/overtrue/flysystem-qiniu) 
[![Latest Unstable Version](https://poser.pugx.org/overtrue/flysystem-qiniu/v/unstable.svg)](https://packagist.org/packages/overtrue/flysystem-qiniu) 
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/overtrue/flysystem-qiniu/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/overtrue/flysystem-qiniu/?branch=master) 
[![Code Coverage](https://scrutinizer-ci.com/g/overtrue/flysystem-qiniu/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/overtrue/flysystem-qiniu/?branch=master) 
[![Total Downloads](https://poser.pugx.org/overtrue/flysystem-qiniu/downloads)](https://packagist.org/packages/overtrue/flysystem-qiniu) 
[![License](https://poser.pugx.org/overtrue/flysystem-qiniu/license)](https://packagist.org/packages/overtrue/flysystem-qiniu)

# Requirement

- PHP >= 8.0.2

# Installation

```shell
$ composer require "overtrue/flysystem-qiniu"
```

# Usage

```php
use League\Flysystem\Filesystem;
use Overtrue\Flysystem\Qiniu\QiniuAdapter;
use Overtrue\Flysystem\Qiniu\Plugins\FetchFile;

$accessKey = 'xxxxxx';
$secretKey = 'xxxxxx';
$bucket = 'test-bucket-name';
$domain = 'xxxx.bkt.clouddn.com'; // or with protocol: https://xxxx.bkt.clouddn.com

$adapter = new QiniuAdapter($accessKey, $secretKey, $bucket, $domain);

$flysystem = new League\Flysystem\Filesystem($adapter);
```

## API

```php
bool $flysystem->write('file.md', 'contents');
bool $flysystem->write('file.md', 'http://httpbin.org/robots.txt', ['mime' => 'application/redirect302']);
bool $flysystem->writeStream('file.md', fopen('path/to/your/local/file.jpg', 'r'));
bool $flysystem->rename('foo.md', 'bar.md');
bool $flysystem->copy('foo.md', 'foo2.md');
bool $flysystem->delete('file.md');
bool $flysystem->has('file.md');
bool $flysystem->fileExists('file.md');
bool $flysystem->directoryExists('path/to/dir');
string|false $flysystem->read('file.md');
array $flysystem->listContents();
int $flysystem->fileSize('file.md');
string $flysystem->getAdapter()->getUrl('file.md'); 
string $flysystem->mimeType('file.md');
```

# Integration

- Laravel 5: [overtrue/laravel-filesystem-qiniu](https://github.com/overtrue/laravel-filesystem-qiniu)
- Yii2: [krissss/yii2-filesystem-qiniu](https://github.com/krissss/yii2-filesystem-qiniu)

## PHP 扩展包开发

> 想知道如何从零开始构建 PHP 扩展包？
>
> 请关注我的实战课程，我会在此课程中分享一些扩展开发经验 —— [《PHP 扩展包实战教程 - 从入门到发布》](https://learnku.com/courses/creating-package)

# License

MIT
