<?php

namespace frontend\widgets;

use common\models\Slider;
use yii\base\Widget;

class SliderWidget extends Widget
{

    public function init()
    {
        parent::init();

        $sliders = Slider::find()->where(['is_published' => 1])->all();

        echo $this->render('slider', [
            'sliders' => $sliders,
        ]);

    }

}
