<?php

namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Factory\ElementFactory;
use SurveyJsPhpSdk\Model\Element\BooleanElement;
use SurveyJsPhpSdk\Parser\TextParser;

class BooleanElementParser extends AbstractDefaultElementParser {
    protected function setupElement(): void {
        $this->element = new BooleanElement();
    }

    protected function configure(\stdClass $data): void {
        parent::configure($data);

        if (isset($data->labelTrue)) {
            $textParser = new TextParser();
            $this->element->setLabelTrue($textParser->parse($data->labelTrue));
        }

        if (isset($data->labelFalse)) {
            $textParser = new TextParser();
            $this->element->setLabelFalse($textParser->parse($data->labelFalse));
        }
    }
}
