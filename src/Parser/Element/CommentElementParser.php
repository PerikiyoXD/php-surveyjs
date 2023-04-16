<?php


namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Model\Element\CommentElement;

class CommentElementParser extends AbstractDefaultElementParser
{
    protected function setupElement(): void
    {
        $this->element = new CommentElement();
    }
}
