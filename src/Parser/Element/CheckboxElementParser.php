<?php


namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Model\Element\CheckboxElement;

class CheckboxElementParser extends AbstractChoiceElementParser
{
    protected function setupElement(): void
    {
        $this->element = new CheckboxElement();
    }
}
