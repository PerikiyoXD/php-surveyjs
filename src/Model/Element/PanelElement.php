<?php

namespace SurveyJsPhpSdk\Model\Element;

use SurveyJsPhpSdk\Model\TextModel;

class PanelElement extends AbstractElement
{
    private $elements;

    private $startWithNewLine;

    public function getElements(): array
    {
        return $this->elements;
    }

    public function setElements(array $elements): void
    {
        $this->elements = $elements;
    }

    public function doesStartWithNewLine(): bool
    {
        return $this->startWithNewLine;
    }

    public function setStartWithNewLine(bool $startWithNewLine): void
    {
        $this->startWithNewLine = $startWithNewLine;
    }
}
