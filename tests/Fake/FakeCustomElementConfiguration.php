<?php


namespace SurveyJsPhpSdk\Tests\Fake;


use SurveyJsPhpSdk\Configuration\ElementConfigurationInterface;
use SurveyJsPhpSdk\Model\Element\ElementInterface;
use SurveyJsPhpSdk\Parser\Element\AbstractElementParser;

class FakeCustomElementConfiguration implements ElementConfigurationInterface
{
    public function getType(): string
    {
        return 'custom_test_element_type';
    }

    public function getElement(): ElementInterface
    {
        return new FakeCustomElementModel();
    }

    public function getParser(): AbstractElementParser
    {
        return new FakeCustomElementParser();
    }
}
