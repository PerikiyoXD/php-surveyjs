<?php

namespace SurveyJsPhpSdk\Model;

// All elements share these properties,
// shouldn't be duplicated in each element
class AbstractBaseModel {
    /**
     * @var TextModel
     */
    private $description;

    /**
     * @var TextModel
     */
    private $title;

    public function getDescription(): TextModel {
        return $this->description;
    }

    public function setDescription(TextModel $description): self {
        $this->description = $description;

        return $this;
    }

    public function getTitle(): TextModel {
        return $this->title;
    }

    public function setTitle(TextModel $title): self {
        $this->title = $title;

        return $this;
    }
}
