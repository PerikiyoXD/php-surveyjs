<?php


namespace SurveyJsPhpSdk\Tests\Fake;


use SurveyJsPhpSdk\Parser\Element\AbstractElementParser;

class FakeCustomElementParser extends AbstractElementParser
{
    protected function setupElement(): void
    {
        $this->element = new FakeCustomElementModel();
    }
}
