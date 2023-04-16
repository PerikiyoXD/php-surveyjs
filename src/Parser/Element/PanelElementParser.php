<?php


namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Exception\InvalidTextElementTypeException;
use SurveyJsPhpSdk\Factory\ElementFactory;
use SurveyJsPhpSdk\Model\Element\PanelElement;
use SurveyJsPhpSdk\Parser\TextParser;

class PanelElementParser extends AbstractDefaultElementParser
{
    protected function setupElement(): void
    {
        $this->element = new PanelElement();
    }

    protected function configure(\stdClass $data): void
    {
        parent::configure($data);

        if (isset($data->elements)) {
            $this->element->setElements($this->parseElements($data->elements));
        }
    }

    protected function parseElements(array $elements): array
    {
        $parsedElements = [];

        foreach ($elements as $element) {
            $parsedElements[] = ElementFactory::create($element, null);
        }

        return $parsedElements;
    }
}
