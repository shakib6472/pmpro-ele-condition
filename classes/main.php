<?php

namespace PMProELECondition;
include_once __DIR__ . '/helpers.php';

class Main
{
    public function __construct()
    {
        add_filter('body_class', [$this, 'shakib_add_pmpro_level_to_body_class']);
        //Widgets
        add_action('elementor/element/common/_section_style/after_section_end', [$this, 'pmpro_visibility_control'], 10, 3);
        //Container and Column
        add_action('elementor/element/column/section_advanced/after_section_end', [$this, 'pmpro_visibility_control'], 10, 3);
        add_action('elementor/element/container/section_layout/after_section_end', [$this, 'pmpro_visibility_control'], 10, 3);
        // Add Elementor hooks for applying conditional visibility
        add_action('elementor/frontend/the_content', [$this, 'pmpro_apply_visibility_control']);
    }

    /**
     * Add PMPro membership level to <body> classes.
     */
    function shakib_add_pmpro_level_to_body_class($classes)
    {
        if (is_user_logged_in()) {
            $level = pmpro_getMembershipLevelForUser(get_current_user_id());
            if ($level) {

                // Add level name as a class (converted to lowercase and dash-separated)
                $classes[] = 'pmpro-level-' . sanitize_html_class(strtolower(str_replace(' ', '-', $level->name)));

            } else { 
                $classes[] = 'pmpro-level-none';
            }
        } else { 
            $classes[] = 'pmpro-level-guest';
        }

        return $classes;
    }


    public function pmpro_visibility_control($element, $args)
    {

        $element->start_controls_section(
            'ecv_conditional_visibility_section',
            [
                'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
                'label' => __('PMPRO  Ele Condition', 'pmpro-ele-condition'),
            ]
        );

        $options = (new Helpers())->pmpro_ele_condition_init();


        $element->add_control(
            'pmpro_ele_condition',
            [
                'label' => esc_html__('Enable PMPRO Conditional Visibility', 'pmpro-ele-condition'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'pmpro-ele-condition'),
                'label_off' => esc_html__('Off', 'pmpro-ele-condition'),
                'return_value' => 'yes',   // ON = "yes", OFF = ''
                'default' => '',
                'frontend_available' => true,
            ]
        );

        // Notice shown when ON
        $element->add_control(
            'pmpro_ele_condition_notice_show',
            [
                'type' => \Elementor\Controls_Manager::NOTICE,
                'notice_type' => 'info',
                'dismissible' => true,
                'heading' => esc_html__('The element will be SHOWN for selected members.', 'pmpro-ele-condition'),
                'condition' => [
                    'pmpro_ele_condition' => 'yes',
                ],
                'frontend_available' => true,
            ]
        );

        // Notice shown when OFF
        $element->add_control(
            'pmpro_ele_condition_notice_hide',
            [
                'type' => \Elementor\Controls_Manager::NOTICE,
                'notice_type' => 'info',
                'dismissible' => true,
                'heading' => esc_html__('The element will be HIDDEN for selected members.', 'pmpro-ele-condition'),
                'condition' => [

                    'pmpro_ele_condition!' => 'yes',
                ],
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'pmpro_ele_condition_show_or_hide',
            [
                'label' => esc_html__('Element will be', 'pmpro-ele-condition'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Hide', 'pmpro-ele-condition'),
                'label_off' => esc_html__('Show', 'pmpro-ele-condition'),
                'return_value' => 'yes',   // ON = "yes", OFF = ''
                'default' => 'yes',
                'condition' => [
                    'pmpro_ele_condition' => 'yes',
                ],
                'frontend_available' => true,
            ]
        );
        // URL Parameter Name
        $element->add_control(
            'pmpro_member_levels',
            [
                'label' => esc_html__('Select Membership Levels', 'pmpro-ele-condition'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => $options,
                'default' => ['pmpro-level-none'], // Default to an empty array
                'description' => esc_html__('Select the membership levels for which this element should be visible. If no levels are selected, the element will be visible to all users.', 'pmpro-ele-condition'),
                'condition' => [
                    'pmpro_ele_condition' => 'yes',
                ],
                'frontend_available' => true,

            ]
        );
        $element->end_controls_section();
    }
    public function pmpro_apply_visibility_control($content)
    {
        // Load HTML into DOMDocument
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $content); // prevent encoding issues
        libxml_clear_errors();
        $xpath = new \DOMXPath($dom);
        // Find all divs with data-settings attribute
        $nodes = $xpath->query('//div[@data-settings]');

        foreach ($nodes as $node) {
            $data_settings_json = html_entity_decode($node->getAttribute('data-settings'));
            $settings = json_decode($data_settings_json, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                // Example: Check your PMPro condition
                if (!empty($settings['pmpro_ele_condition']) && $settings['pmpro_ele_condition'] === 'yes') {
                    $hide = !empty($settings['pmpro_ele_condition_show_or_hide']) && $settings['pmpro_ele_condition_show_or_hide'] === 'yes';
                    $levels = !empty($settings['pmpro_member_levels']) ? $settings['pmpro_member_levels'] : [];
                    if (is_user_logged_in()) {
                        $user_level_class = pmpro_getMembershipLevelForUser(get_current_user_id());
                        if ($user_level_class) {
                            // Convert level name to class format
                             $user_level = 'pmpro-level-' . sanitize_html_class(strtolower(str_replace(' ', '-', $user_level_class->name)));
                        } else {
                            // If no level found, treat as guest
                            $user_level = 'pmpro-level-none';
                        }
                    } else {
                        $user_level = 'pmpro-level-guest';
                    }

                    if ($hide) {
                        // if found user level is not in the selected levels, hide the element
                        if (in_array($user_level, $levels)) {
                            $node->parentNode->removeChild($node); // Remove the node from the DOM
                        }
                    } else {
                        if (!in_array($user_level, $levels)) {
                            $node->parentNode->removeChild($node); // Remove the node from the DOM
                        }
                    }
                }
            }
        }

        // Save and return modified HTML content
        return $dom->saveHTML();
    }

}

//initialize the plugin
new Main();