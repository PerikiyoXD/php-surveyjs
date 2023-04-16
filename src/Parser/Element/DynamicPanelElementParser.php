<?php


namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Factory\ElementFactory;
use SurveyJsPhpSdk\Model\Element\DynamicPanelElement;

class DynamicPanelElementParser extends AbstractDefaultElementParser
{
    protected function setupElement(): void
    {
        $this->element = new DynamicPanelElement();
    }

    protected function configure(\stdClass $data): void
    {
        parent::configure($data);

        if (isset($data->templateElements)) {
            $this->element->setTemplateElements($this->parseElements($data->templateElements));
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
