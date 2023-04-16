<?php

namespace SurveyJsPhpSdk\Model\Element;

use SurveyJsPhpSdk\Model\ResultModel;

class CommentElement extends AbstractElement
{
    public function isValidResult(ResultModel $result): bool
    {
         return $this->getName() === $result->getQuestion();
    }
}
