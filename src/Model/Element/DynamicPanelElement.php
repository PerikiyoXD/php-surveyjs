<?php

namespace SurveyJsPhpSdk\Model\Element;

class DynamicPanelElement extends AbstractElement
{
    private $templateElements;

    public function setTemplateElements(array $templateElements): void
    {
        $this->templateElements = $templateElements;
    }

    public function getTemplateElements(): array
    {
        return $this->templateElements;
    }

}
