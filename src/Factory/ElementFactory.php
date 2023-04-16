<?php

namespace SurveyJsPhpSdk\Factory;

use SurveyJsPhpSdk\Configuration\ElementConfigurationInterface;
use SurveyJsPhpSdk\Exception\ElementConfigurationErrorException;
use SurveyJsPhpSdk\Exception\MissingElementConfigurationException;
use SurveyJsPhpSdk\Model\Element\ElementInterface;
use SurveyJsPhpSdk\Parser\Element\BooleanElementParser;
use SurveyJsPhpSdk\Parser\Element\CheckboxElementParser;
use SurveyJsPhpSdk\Parser\Element\CommentElementParser;
use SurveyJsPhpSdk\Parser\Element\DynamicPanelElementParser;
use SurveyJsPhpSdk\Parser\Element\MultipleChoiceMatrixElementParser;
use SurveyJsPhpSdk\Parser\Element\PanelElementParser;
use SurveyJsPhpSdk\Parser\Element\RadioGroupElementParser;
use SurveyJsPhpSdk\Parser\Element\RatingElementParser;
use SurveyJsPhpSdk\Parser\Element\SingleChoiceMatrixElementParser;
use SurveyJsPhpSdk\Parser\Element\TextElementParser;

class ElementFactory {
    public const CHECKBOX_TYPE = 'checkbox';
    public const COMMENT_TYPE = 'comment';
    public const RADIO_GROUP_TYPE = 'radiogroup';
    public const RATING_TYPE = 'rating';
    public const TEXT_TYPE = 'text';
    public const NUMBER_TYPE = 'number';
    public const COLOR_TYPE = 'color';
    public const DATE_TYPE = 'date';
    public const DATETIME_TYPE = 'datetime';
    public const DATETIME_LOCAL_TYPE = 'datetime-local';
    public const EMAIL_TYPE = 'email';
    public const PASSWORD_TYPE = 'password';
    public const RANGE_TYPE = 'range';
    public const TEL_TYPE = 'tel';
    public const TIME_TYPE = 'time';
    public const MONTH_TYPE = 'month';
    public const WEEK_TYPE = 'week';
    public const URL_TYPE = 'url';
    public const BOOLEAN_TYPE = 'boolean';
    public const PANEL_TYPE = 'panel';
    public const DYNAMIC_PANEL_TYPE = 'paneldynamic';
    public const MATRIX_TYPE = 'matrix';
    public const MATRIX_DROPDOWN_TYPE = 'matrixdropdown';

    public const KNOWN_TYPES = [
        self::CHECKBOX_TYPE,
        self::COMMENT_TYPE,
        self::RADIO_GROUP_TYPE,
        self::RATING_TYPE,
        self::TEXT_TYPE,
        self::PANEL_TYPE,
        self::BOOLEAN_TYPE,
        self::MATRIX_TYPE,
    ];

    public const TEXT_SUBTYPES = [
        self::TEXT_TYPE,
        self::NUMBER_TYPE,
        self::COLOR_TYPE,
        self::DATE_TYPE,
        self::DATETIME_LOCAL_TYPE,
        self::DATETIME_TYPE,
        self::EMAIL_TYPE,
        self::PASSWORD_TYPE,
        self::RANGE_TYPE,
        self::TEL_TYPE,
        self::TIME_TYPE,
        self::MONTH_TYPE,
        self::WEEK_TYPE,
        self::URL_TYPE
    ];

    /**
     * @param \stdClass $element
     * @param ElementConfigurationInterface|null $configuration
     *
     * @throws ElementConfigurationErrorException
     * @throws MissingElementConfigurationException
     *
     * @return ElementInterface
     */
    public static function create(\stdClass $element, ?ElementConfigurationInterface $configuration): ElementInterface {
        switch ($element->type) {
            case self::CHECKBOX_TYPE:
                $parser = new CheckboxElementParser();
                return $parser->parse($element);
            case self::COMMENT_TYPE:
                $parser = new CommentElementParser();
                return $parser->parse($element);
            case self::RADIO_GROUP_TYPE:
                $parser = new RadioGroupElementParser();
                return $parser->parse($element);
            case self::RATING_TYPE:
                $parser = new RatingElementParser();
                return $parser->parse($element);
            case self::TEXT_TYPE:
                $parser = new TextElementParser();
                return $parser->parse($element);
            case self::BOOLEAN_TYPE:
                $parser = new BooleanElementParser();
                return $parser->parse($element);
            case self::PANEL_TYPE:
                $parser = new PanelElementParser();
                return $parser->parse($element);
            case self::DYNAMIC_PANEL_TYPE:
                $parser = new DynamicPanelElementParser();
                return $parser->parse($element);
            case self::MATRIX_TYPE:
                $parser = new SingleChoiceMatrixElementParser();
                return $parser->parse($element);
            default:
                if ($element->type === $configuration->getType()) {
                    //checking that custom element parser returns the correct custom element model as in configuration
                    if (get_class($model = $configuration->getParser()->parse($element)) !== get_class($configuration->getElement())) {
                        throw new ElementConfigurationErrorException('Configured model does not correspond to model returned by parser in configuration for type: ' . $configuration->getType());
                    }

                    return $model;
                }
                throw new MissingElementConfigurationException($element->type);
        }
    }
}
