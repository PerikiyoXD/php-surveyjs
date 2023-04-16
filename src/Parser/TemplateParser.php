<?php

namespace SurveyJsPhpSdk\Parser;

use SurveyJsPhpSdk\Configuration\ElementConfigurationInterface;
use SurveyJsPhpSdk\Exception\ElementConfigurationErrorException;
use SurveyJsPhpSdk\Exception\ElementTypeNotFoundException;
use SurveyJsPhpSdk\Exception\InvalidElementConfigurationException;
use SurveyJsPhpSdk\Exception\MissingElementConfigurationException;
use SurveyJsPhpSdk\Exception\PageDataNotFoundException;
use SurveyJsPhpSdk\Factory\ElementFactory;
use SurveyJsPhpSdk\Model\TemplateModel;

class TemplateParser {
    /**
     * @var ElementConfigurationInterface[]
     */
    private $customConfigurations = [];

    /**
     * TemplateParser constructor.
     *
     * @param iterable $customConfigurations
     *
     * @throws InvalidElementConfigurationException
     */
    public function __construct(iterable $customConfigurations = []) {
        foreach ($customConfigurations as $customConfiguration) {
            if (($customConfiguration instanceof ElementConfigurationInterface) === false) {
                throw new InvalidElementConfigurationException();
            }
            $this->customConfigurations[$customConfiguration->getType()] = $customConfiguration;
        }
    }

    /**
     * @param string $jsonTemplate
     *
     * @throws ElementTypeNotFoundException
     * @throws MissingElementConfigurationException
     * @throws PageDataNotFoundException
     * @throws ElementConfigurationErrorException
     *
     * @return TemplateModel
     */
    public function parse(string $jsonTemplate): TemplateModel {
        $template = json_decode($jsonTemplate);

        // Create template model
        $surveyTemplateModel = new TemplateModel();

        // Parse title
        if (isset($template->title)) {
            $textParser = new TextParser();
            $surveyTemplateModel->setTitle($textParser->parse($template->title));
        }

        // Parse description
        if (isset($template->description)) {
            $textParser = new TextParser();
            $surveyTemplateModel->setDescription($textParser->parse($template->description));
        }

        // Parse locale
        if (isset($template->locale)) {
            $surveyTemplateModel->setLocale($template->locale);
        }

        // Parse pages
        if (isset($template->pages)) {
            foreach ($template->pages as $page) {
                $pageModel = (new PageParser())->parse($page);

                // Parse elements in page
                if (isset($page->elements)) {
                    foreach ($page->elements as $element) {
                        $config = $this->getConfigForElement($element);

                        // Add element to page
                        $pageModel->addElement(ElementFactory::create($element, $config));
                    }
                }

                // Add page to template
                $surveyTemplateModel->addPage($pageModel);
            }
        }

        return $this->setDefaultProperties($surveyTemplateModel, $template);
    }

    /**
     * @param \stdClass $element
     *
     * @throws ElementTypeNotFoundException
     * @throws MissingElementConfigurationException
     *
     * @return ElementConfigurationInterface|null
     */
    private function getConfigForElement(\stdClass $element): ?ElementConfigurationInterface {
        if (!isset($element->type)) {
            throw new ElementTypeNotFoundException();
        }

        if (in_array($element->type, ElementFactory::KNOWN_TYPES)) {
            return null;
        }

        if (!isset($this->customConfigurations[$element->type])) {
            throw new MissingElementConfigurationException($element->type);
        }

        return $this->customConfigurations[$element->type];
    }

    /**
     * @param TemplateModel $model
     * @param \stdClass $data
     *
     * @return TemplateModel
     */
    private function setDefaultProperties(TemplateModel $model, \stdClass $data): TemplateModel {
        if (isset($data->showNavigationButtons)) {
            $model->setShowNavigationButtons($data->showNavigationButtons);
        }

        if (isset($data->showPageTitles)) {
            $model->setShowPageTitles($data->showPageTitles);
        }

        if (isset($data->showCompletedPage)) {
            $model->setShowCompletedPage($data->showCompletedPage);
        }

        if (isset($data->showQuestionNumbers)) {
            $model->setShowQuestionNumbers($data->showQuestionNumbers);
        }

        return $model;
    }
}
