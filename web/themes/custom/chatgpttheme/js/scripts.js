(function ($, Drupal) {
    Drupal.behaviors.myCustomThemeBehavior = {
        attach: function (context, settings) {
            console.log('Global script loaded');
            // Add your custom JavaScript here
            $('#my-element', context).once('myCustomThemeBehavior').each(function () {
                $(this).text('Hello, Drupal!');
            });
        }
    };
})(jQuery, Drupal);