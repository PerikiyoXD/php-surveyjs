<?php

namespace SurveyJsPhpSdk\Model\Element;

use SurveyJsPhpSdk\Model\TextModel;

class BooleanElement extends AbstractElement
{
    protected $labelTrue;

    protected $labelFalse;

    public function getLabelTrue(): TextModel
    {
        return $this->labelTrue;
    }

    public function setLabelTrue(TextModel $labelTrue): void
    {
        $this->labelTrue = $labelTrue;
    }

    public function getLabelFalse(): TextModel
    {
        return $this->labelFalse;
    }

    public function setLabelFalse(TextModel $labelFalse): void
    {
        $this->labelFalse = $labelFalse;
    }

}
