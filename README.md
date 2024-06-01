# php-json-to-array-to-code
Convert JSON object to PHP array or render array as PHP code

把一个PHP数组转换成PHP代码,可方便地用于生成配置文件.<br />

## Usage
```php
include(__DIR__ . '/src.php');
$json = '{  
   "hello":"world",
   "properties":{  
      "url":"https://github.com/matejbukovsky/php-json-to-array",
      "convert":true
   },
   "test": ["first", "second", 0]
}';
```
## Return PHP code
```php
$code = '$array = ';
$code .= getCode(json_decode($json, TRUE));
$code .= ';';

echo $code;

$array = [
	'hello' => 'world',
	'properties' => [
		'url' => 'https://github.com/matejbukovsky/php-json-to-array',
		'convert' => TRUE
	],
	'test' => ['first','second',0]
];
```