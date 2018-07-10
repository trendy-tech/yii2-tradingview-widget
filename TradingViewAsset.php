<?php

namespace TrendyTech;

use yii\web\AssetBundle;

/**
 * Class TradingViewAsset
 */
class TradingViewAsset extends AssetBundle
{
    /**
     * @var string the directory that contains the source asset files for this asset bundle
     */
    public $sourcePath = '@vendor/tradingview/charting_library';

     /**
     * Registers additional JavaScript files required by the widget.
     *
     * @param array $scripts list of additional JavaScript files to register.
     * @return $this
     */
    public function withScripts($scripts = [])
    {
        // main library
        $this->js[] = 'charting_library/charting_library.min.js';
        // add files
        foreach ($scripts as $script) $this->js[] = "$script.js";
        
        return $this;
    }
}
