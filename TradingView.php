<?php

namespace TrendyTech;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\web\View;
use yii\base\Widget;

/**
 * Class TradingView
 * 
 * @author Artem Sinkov <ceo@trendytech.ru>
 * @link https://github.com/trendy-tech/yii2-tradingview-widget
 * @license https://github.com/trendy-tech/yii2-tradingview-widget/blob/master/LICENSE.md BSD 3-Clause License
 */
class TradingView extends Widget
{
    public $options = [];
    public $htmlOptions = [];
    public $scripts = [];

    /**
     * Renders the widget.
     */
    public function run()
    {
        // determine the ID of the container element
        if (isset($this->htmlOptions['id'])) {
            $this->id = $this->htmlOptions['id'];
        } else {
            $this->id = $this->htmlOptions['id'] = $this->getId();
        }

        // render the container element
        echo Html::tag('div', '', $this->htmlOptions);

        // check if options parameter is a json string
        if (is_string($this->options)) {
            $this->options = Json::decode($this->options);
        }
        
        // UDF Datafeed
        if (isset($this->options['datafeed']) && strpos($this->options['datafeed'], 'UDFCompatibleDatafeed') !== false) {
            $this->scripts[] = 'datafeeds/udf/dist/polyfills';
            $this->scripts[] = 'datafeeds/udf/dist/bundle';
        }

        // merge options with default values
        $defaultOptions = [
            'container_id' => $this->id
        ];
        $this->options = ArrayHelper::merge($defaultOptions, $this->options);

        $this->registerAssets();

        parent::run();
    }

    /**
     * Registers required assets and the executing code block with the view
     */
    protected function registerAssets()
    {
        // register the necessary script files
        $bundle = TradingViewAsset::register($this->view)->withScripts($this->scripts);
        
        $this->options['library_path'] = $bundle->baseUrl . '/charting_library/';

        // prepare and register JavaScript code block
        $jsOptions = Json::encode($this->options);
        $js = "var widget = window.tvWidget = new TradingView.widget($jsOptions);";
        $key = __CLASS__ . '#' . $this->id;
        
        $this->view->registerJs($js, View::POS_READY, $key);
    }
}
