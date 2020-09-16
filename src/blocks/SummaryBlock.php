<?php

namespace luya\forms\blocks;

use luya\cms\base\PhpBlock;
use luya\forms\blockgroups\FormGroup;
use luya\helpers\StringHelper;
use Yii;

class SummaryBlock extends PhpBlock
{
    public $template = '<p>{{label}}: {{value}}</p>';


    public function blockGroup()
    {
        return FormGroup::class;
    }

    public function config()
    {
        return [
            'vars' => [
                ['var' => 'template', 'label' => 'Row Template', 'type' => self::TYPE_TEXTAREA, 'placeholder' => $this->template],
            ]
        ];
    }

    public function getFieldHelp()
    {
        return [
            'template' => 'Variables {{label}} and {{value}} are available',
        ];
    }

    public function admin()
    {
        return 'The Summary of the Data';
    }

    public function name()
    {
        return 'Summary';
    }

    public function frontend()
    {
        $html = null;
        foreach(Yii::$app->forms->model->attributes as $k => $v) {
            $html .= StringHelper::template($this->template, ['label' => $k, 'value' => $v]);
        }

        return $html;
    }
}