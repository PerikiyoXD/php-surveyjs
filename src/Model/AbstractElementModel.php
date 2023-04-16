<?php

namespace SurveyJsPhpSdk\Model;

// All elements share these properties,
// shouldn't be duplicated in each element
class AbstractElementModel extends AbstractBaseModel {
    /**
     * @var string
     */
    private $name;

    /**
     * @var boolean
     */
    private $visible;

    /**
     * @var boolean
     */
    private $readOnly;

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }
}
