<?php defined('ABSPATH') or die("No script kiddies please!");

/**
 * Get current domain of website.
 *
 * @return domain of current site.
 */
function get_current_domain() {
	$domain = get_home_url();


	$domain = str_replace("https://wwww.", "", $domain);
	$domain = str_replace("https://", "", $domain);

	$domain = str_replace("http://wwww.", "", $domain);
	$domain = str_replace("http://", "", $domain);
	
	return $domain;
}

?>


<div id="ringer-popup" class="ringer-popup">
    <div id="ringer-vpx" class="ringer-vpx">
        <div class="vpx-modes">
            <button id="btn-vpx-show" class="ringer-phone-button-1 play-btn" onclick="show_channels()"></button>
        </div>

        <iframe id="iframe-vpx" class="vpx-container" src="<?php echo(WPRC2_SERVER_CALL) ?>/box/<?php echo get_current_domain() ?>:.+" allow="geolocation; microphone; camera" allowfullscreen>
            <p>Your browser do not support iframe. Please update browser to newest version then try again.</p>
        </iframe>
        <button id="btn-vpx-close" class="ringer-phone-button-close close fat thick" onclick="close_channels()" style="display: none;"></button>
    </div>
</div>
