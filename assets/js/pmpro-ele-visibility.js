jQuery(window).on('elementor/frontend/init', function () {
    console.log('PMPro ELE Condition: Document ready');
    elementorFrontend.hooks.addAction('frontend/element_ready/widget', function ($scope) {
        const settings = $scope.data('settings') || {};
        // console.log('Widget settings:', settings);

        if (settings.pmpro_ele_condition !== 'yes') {
            console.log('PMPro ELE Condition: Not enabled for this widget');
            return;
        }

        const selectedLevels = settings.pmpro_member_levels || [];
        console.log('Selected membership levels:', selectedLevels);

        if (!selectedLevels.length) {
            console.log('PMPro ELE Condition: No membership levels selected');
            return;
        }

        // Simulate condition: element should be hidden
        // const elementShouldBeHidden = true;

        // if (elementShouldBeHidden && settings.pmpro_ele_condition_show_or_hide === 'yes') {
        //     $scope.hide();
        // }
    });
});
