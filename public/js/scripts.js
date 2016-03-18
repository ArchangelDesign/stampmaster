/**
 * Stamp Master
 * copyright (c) Archangel Design 2015
 * @author Rafal Martinez-Marjanski
 * copyright (c) all rights reserved
 */

/**
 * Reacts to click, hides container (wrapper for every view)
 * and redirects to url contained in 'targeturl' attribute
 * if exists. If attribute doesn't exist no redirection takes place
 */
$(document).on('click', '.slide-out-container', function() {
    var target = $(this).attr('targeturl');
    if (typeof target == typeof undefined || target == false) {
        target = false;
    }
    $(".container").hide("1000", function() {
        if (target !== false) {
            history.pushState({}, '', document.location);
            document.location.replace(target);
        }
    });
});

/**
 * blocks the screen while modal box is open
 */
function showOverlay()
{
    $("#global-overlay").fadeIn();
}

/**
 * removes overlay after modal box has been closed
 */
function hideOverlay()
{
    $("#global-overlay").fadeOut();
}

/**
 * close any open dialogs and remove overlay
 */
$(document).on('click', '#global-overlay', function() {
    $(".modal-box").fadeOut();
    hideOverlay();
});