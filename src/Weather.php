<?php


namespace WalkerDistance\Weather;


use GuzzleHttp\Client;
use WalkerDistance\Weather\Exceptions\HttpException;
use WalkerDistance\Weather\Exceptions\InvalidArgumentException;

class Weather
{
    protected $key;

    protected $guzzleOptions = [];

    protected $url = 'https://restapi.amap.com/v3/weather/weatherInfo';

    /**
     * Weather constructor.
     * @param string $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * 获取HTTPClient实例
     * @return Client
     */
    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    /**
     * 设置HTTPClient实例中的参数
     * @param array $options
     */
    public function setHttpClient(array $options)
    {
        $this->guzzleOptions = $options;
    }

    public function getWeather($city, $type = 'base', $format = 'json')
    {
        if (empty($city)) {
            throw new InvalidArgumentException('缺少参数');
        }
        if (!in_array(strtolower($format), ['xml', 'json'])) {
            throw new InvalidArgumentException('无效的响应格式（xml/json）: ' . $format);
        }
        if (!in_array(strtolower($type), ['base', 'all'])) {
            throw new InvalidArgumentException('无效的类型值（base/all）: ' . $type);
        }
        $query = array_filter([
            'key' => $this->key, // 用户在高德地图官网申请的web服务API类型KEY
            'city' => $city,   //城市
            'extensions' => $type, // 气象类型 base 实况天气  all 预报天气
            'output' => $format, //返回格式
        ]);
        try {
            $response = $this->getHttpClient()->get($this->url, ['query' => $query])->getBody()->getContents();
            return json_decode($response, true);
        } catch (\Exception $exception) {
            throw new HttpException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}