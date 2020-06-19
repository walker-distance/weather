<h1 align="center"> weather </h1>

<p align="center"> .</p>


## Installing

```shell
$ composer require walker-distance/weather -vvv
```

## Usage

发布配置文件
```php
php artisan vendor:publish --provider='WalkerDistance\Weather\ServiceProvider'
```

#### 针对laravel5.5版本使用

更新env文件（:API_KEY 高德对应应用的KEY）
```php
WEATHER_API_KEY=*******************
```
使用方法（一）
```php
$city = '北京';
$type = 'all'; //可以不填 默认为实时天气  all表示天气预报
$format = 'json'; //默认为json  支持xml(json) 
app('weather')->getweather($city, $type = null, $format = null);
```

使用方法（二）
```php
//在laravel中使用
protected $weather;

public function __construct(Weather $weather)
{
    $this->weather = $weather;
}

//在方法中使用
public function getWeather(Request $request)
{
    //$city = '北京';
    //$type = 'all'; //可以不填 默认为实时天气  all表示天气预报
    //$format = 'json'; //默认为json  支持xml(json) 
    $city = $request->get('city');
    $response = $this->weather->getWeather($city ?: '北京');
    return $this->success($response);
}
```

使用方法（三）
```php
//$city = '北京';
//$type = 'all'; //可以不填 默认为实时天气  all表示天气预报
//$format = 'json'; //默认为json  支持xml(json) 
$city = '天津';
$key = '';
$weather = new Weather($key);
$response = $weather->getWeather($city,$type = null,$format = null);
```

### 参考
高德开放平台天气接口
https://lbs.amap.com/api/webservice/guide/api/weatherinfo/
