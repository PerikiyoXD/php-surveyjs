<?php

namespace SurveyJsPhpSdk\Parser\Element;

use SurveyJsPhpSdk\Model\Element\SingleChoiceMatrixElement;
use SurveyJsPhpSdk\Parser\ChoiceParser;

class MultipleChoiceMatrixElementParser extends AbstractDefaultElementParser {
    protected function setupElement(): void {
        $this->element = new SingleChoiceMatrixElement();
    }

    protected function configure(\stdClass $data): void {
        parent::configure($data);

        // Parse columns
        if (isset($data->columns)) {
            // Create an empty array for the columns
            $columns = [];

            // Create a new choice parser
            $choiceParser = new ChoiceParser();

            // Parse each column
            foreach ($data->columns as $column) {
                // Add the parsed column to the array
                $columns[] = $choiceParser->parse($column);
            }

            // Set the columns
            $this->element->setColumns($columns);
        }

        // Parse rows
        if (isset($data->rows)) {
            // Create an empty array for the rows
            $rows = [];

            // Create a new choice parser
            $choiceParser = new ChoiceParser();

            // Parse each row
            foreach ($data->rows as $row) {
                // Add the parsed row to the array
                $rows[] = $choiceParser->parse($row);
            }

            // Set the rows
            $this->element->setRows($rows);
        }
    }
}
