<?php

namespace SurveyJsPhpSdk\Model\Element;

class SingleChoiceMatrixElement extends AbstractElement
{
    private $columns;

    private $rows;

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function setColumns(array $columns): void
    {
        $this->columns = $columns;
    }

    public function getRows(): array
    {
        return $this->rows;
    }

    public function setRows(array $rows): void
    {
        $this->rows = $rows;
    }
}
