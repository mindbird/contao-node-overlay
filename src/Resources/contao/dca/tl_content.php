<?php

$GLOBALS['TL_DCA']['tl_content']['palettes']['nodes_overlay'] = '{type_legend},type;{include_legend},nodes,showOnlyOnce,stop;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests;{invisible_legend:hide},invisible';

$GLOBALS['TL_DCA']['tl_content']['fields']['showOnlyOnce'] = [
    'exclude' => true,
    'inputType' => 'checkbox',
    'eval' => ['tl_class' => 'w50 m12 '],
    'sql' => ['type' => 'string', 'length' => 1, 'default' => '0'],
];