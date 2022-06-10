<?php

/**
 * .php-cs-fixer.php
 *
 *  Ref: https://github.com/FriendsOfPHP/PHP-CS-Fixer
 */

return (new \PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR12' => true,// include @PSR1, @PSR2
        'no_blank_lines_after_class_opening' => true,// !PSR-12
        'header_comment' => [
            'comment_type' => 'PHPDoc',
            'header' => '',
            'separate' => 'both',
            'location' => 'after_declare_strict',
        ],
        'array_syntax' => [
            'syntax' => 'short'
        ],
        'no_trailing_comma_in_singleline_array' => true,
        'no_whitespace_before_comma_in_array' => [
            'after_heredoc' => false
        ],
        'normalize_index_brace' => true,
        'trim_array_spaces' => true,
        'braces' => [
            'allow_single_line_closure' => true,
            'allow_single_line_anonymous_class_with_empty_body' => false,
            'position_after_functions_and_oop_constructs' => 'next',
            'position_after_control_structures' => 'same',
            'position_after_anonymous_constructs' => 'same',
        ],
        'cast_spaces' => [
            'space' => 'single'
        ],
        'no_short_bool_cast' => true,
        'class_attributes_separation' => [
            'elements' => [
                'const' => 'one', 'method' => 'one', 'property' => 'one', 'trait_import' => 'none'
            ]
        ],
        'class_definition' => [
            'multi_line_extends_each_single_line' => false,
            'single_item_single_line' => false,
            'single_line' => false,
            'space_before_parenthesis' => false,
        ],
        'no_null_property_initialization' => true,
        'ordered_class_elements' => [
            'order' => [
                'use_trait', 'constant_public', 'constant_protected', 'constant_private',
                'property_public', 'property_protected', 'property_private',
                'construct', 'destruct',
                'method_public', 'method_protected', 'method_private'
            ],
            'sort_algorithm' => 'none'
        ],
        'ordered_interfaces' => [
            'order' => 'alpha',
            'direction' => 'ascend',
        ],
        'no_empty_comment' => true,
        'single_line_comment_style' => [
            'comment_types' => [
                'asterisk', 'hash'
            ]
        ],
        'empty_loop_body' => [
            'style' => 'braces'
        ],
        'no_superfluous_elseif' => true,
        'no_trailing_comma_in_list_call' => true,
        'blank_line_before_statement' => [
            'statements' => [
                'continue', 'declare', 'do', 'for', 'foreach', 'if', 'return', 'switch', 'throw', 'try', 'while',
                'yield', 'yield_from'
            ],
        ],
        'no_unneeded_control_parentheses' => [
            'statements' => [
                'break', 'clone', 'continue', 'echo_print', 'return', 'switch_case', 'yield', 'yield_from'
            ]
        ],
        'no_unneeded_curly_braces' => [
            'namespaces' => true
        ],
        'no_useless_else' => true,
        'switch_continue_to_break' => true,
        'combine_nested_dirname' => true,
        'fopen_flag_order' => true,
        'fopen_flags' => true,
        'function_typehint_space' => true,
        'implode_call' => true,
        'lambda_not_used_import' => true,
        'method_argument_space' => [
            'keep_multiple_spaces_after_comma' => false,
            'on_multiline' => 'ensure_fully_multiline',
            'after_heredoc' => true,
        ],
        'no_useless_sprintf' => true,
        'nullable_type_declaration_for_default_null_value' => true,
        'regular_callable_call' => true,// Callables must be called without using call_user_func* when possible
        'single_line_throw' => true,
        'static_lambda' => true,
        'combine_consecutive_issets' => true,
        'combine_consecutive_unsets' => true,
        'is_null' => true,
        'no_unset_on_property' => true,
        'single_space_after_construct' => true,
        'list_syntax' => [
            'syntax' => 'short'
        ],
        'clean_namespace' => true,
        'no_leading_namespace_whitespace' => true,
        'binary_operator_spaces' => [
            'default' => 'single_space',
            'operators' => []
        ],
        'concat_space' => [
            'spacing' => 'one'
        ],
        'logical_operators' => true,
        'object_operator_without_whitespace' => true,
        'operator_linebreak' => [
            'only_booleans' => false,
            'position' => 'beginning'
        ],
        'standardize_increment' => true,
        'standardize_not_equals' => true,
        'ternary_to_null_coalescing' => true,
        'unary_operator_spaces' => true,
        'echo_tag_syntax' => [
            'format' => 'long',
            'long_function' => 'echo'
        ],
        'linebreak_after_opening_tag' => true,
        'align_multiline_comment' => [
            'comment_type' => 'phpdocs_only'
        ],
        'general_phpdoc_annotation_remove' => [
            'annotations' => [
                'package'
            ],
        ],
        'no_blank_lines_after_phpdoc' => true,
        'no_empty_phpdoc' => true,
        'phpdoc_align' => [
            'tags' => [
                'param', 'property', 'property-read', 'property-write',
                'return', 'throws', 'type', 'var', 'method'
            ],
            'align' => 'vertical'
        ],
        'phpdoc_indent' => true,
        'phpdoc_annotation_without_dot' => true,
        'phpdoc_line_span' => true,
        'phpdoc_no_access' => true,
        'phpdoc_scalar' => true,
        'phpdoc_separation' => true,
        'phpdoc_tag_type' => true,
        'phpdoc_types' => true,
        'phpdoc_var_annotation_correct_order' => true,
        'multiline_whitespace_before_semicolons' => [
            'strategy' => 'no_multi_line',
        ],
        'no_empty_statement' => true,
        'no_singleline_whitespace_before_semicolons' => true,
        'semicolon_after_instruction' => true,
        'simple_to_complex_string_variable' => true,
        'array_indentation' => true,
        'heredoc_indentation' => [
            'indentation' => 'same_as_start'
        ],
        'method_chaining_indentation' => true,
        'no_spaces_around_offset' => true,
        'types_spaces' => true,
        'ordered_imports' => [
            'imports_order' => [
                'const', 'class', 'function'
            ],
            'sort_algorithm' => 'alpha',
        ],
        'set_type_to_cast' => true,
        'no_multiline_whitespace_around_double_arrow' => true,
        'declare_strict_types' => false,
        'no_unused_imports' => true,
        'not_operator_with_successor_space' => false,
        'not_operator_with_space' => false,
        'php_unit_strict' => false,
        'single_quote' => true,
        'multiline_comment_opening_closing' => true,
    ])
    ->setFinder(
        \PhpCsFixer\Finder::create()
            ->exclude('public')
            ->exclude('runtime')
            ->exclude('vendor')
            ->in(__DIR__)
    )
    ->setUsingCache(false);
