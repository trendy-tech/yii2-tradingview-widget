<h1>Yii2 TradingView Chart Widget</h1>

TradingView Charting Library wrapper for Yii2.

Installation
-------------
Before install, you need to get access to the private repository "https://github.com/tradingview/charting_library":
https://tradingview.com/HTML5-stock-forex-bitcoin-charting-library/
~~~
composer require trendy-tech/yii2-tradingview-widget dev-master
~~~

Usage
-------------
~~~
use TrendyTech\TradingView;
use yii\web\JsExpression;

echo TradingView::widget([
    //'debug' => true, // uncomment this line to see Library errors and warnings in the console
    'fullscreen' => true,
    'symbol' => 'AAPL',
    'interval' => 'D',
    'datafeed' => new JsExpression('new Datafeeds.UDFCompatibleDatafeed("https://demo_feed.tradingview.com")'),
    'locale' => 'en',
    //	Regression Trend-related functionality is not implemented yet, so it's hidden for a while
    'drawings_access' => ['type' => 'black', 'tools' => ['name' => 'Regression Trend']],
    'disabled_features' => ['use_localstorage_for_settings'],
    'enabled_features' => ['study_templates'],
    'charts_storage_url' => 'http://saveload.tradingview.com',
    'charts_storage_api_version' => '1.1',
    'client_id' => 'tradingview.com',
    'user_id' => 'public_user_id'
]);
~~~
