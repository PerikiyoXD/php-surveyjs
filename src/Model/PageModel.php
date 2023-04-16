<?php

namespace SurveyJsPhpSdk\Model;

use SurveyJsPhpSdk\Model\AbstractElementModel;
use SurveyJsPhpSdk\Model\Element\ElementInterface;

class PageModel extends AbstractElementModel
{
    /**
     * @var ElementInterface[]
     */
    private $elements = [];

    /**
     * @return ElementInterface[]
     */
    public function getElements(): array
    {
        return $this->elements;
    }

    public function addElement(ElementInterface $elementToAdd): self
    {
        // TODO Can we add only an element by name?
        foreach ($this->elements as $element) {
            if ($element->getName() === $elementToAdd->getName()) {
                return $this;
            }
        }

        $this->elements[] = $elementToAdd;

        return $this;
    }

//    public function removeElement(ElementInterface $elementToRemove): self
//    {
//        foreach($this->elements as $index => $element){
//            if($element->getName() === $elementToRemove->getName()) {
//                unset($this->elements[$index]);
//                return $this;
//            }
//        }
//
//        return $this;
//    }
}
