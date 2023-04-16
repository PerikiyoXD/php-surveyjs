<?php

namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Exception\ElementNameNotFoundException;
use SurveyJsPhpSdk\Model\Element\ElementInterface;

abstract class AbstractElementParser implements ElementParserInterface
{
    protected $element;

    protected function configure(\stdClass $data): void
    {
        // If the element has no name, throw an exception
        if (!isset($data->name) || empty($data->name)) {
            throw new ElementNameNotFoundException($data->type);
        }

        // Set the element name
        $this->element->setName($data->name);
    }

    public function parse(\stdClass $data): ElementInterface
    {
        $this->setupElement();

        $this->configure($data);

        return $this->element;
    }

    abstract protected function setupElement(): void;
}
