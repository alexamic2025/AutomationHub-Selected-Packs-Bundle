<?php
/**
 * Plugin Name: AutomationHub LLM Integration
 * Plugin URI: https://alldataflow.com/automationhub
 * Description: Integrates WordPress with AutomationHub API for document processing, AI analysis, and SharePoint synchronization.
 * Version: 1.0.0
 * Author: AutomationHub
 * License: GPL2
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('AUTOMATIONHUB_PLUGIN_URL', plugin_dir_url(__FILE__));
define('AUTOMATIONHUB_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('AUTOMATIONHUB_VERSION', '1.0.0');

class AutomationHubPlugin {
    
    public function __construct() {
        add_action('init', array($this, 'init'));
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_ajax_automationhub_test_connection', array($this, 'test_connection'));
        add_action('wp_ajax_automationhub_process_document', array($this, 'process_document'));
        
        // Register shortcodes
        add_shortcode('automationhub_health', array($this, 'health_shortcode'));
        add_shortcode('automationhub_upload', array($this, 'upload_shortcode'));
    }
    
    public function init() {
        // Initialize plugin
    }
    
    public function settings_page() {
        if (isset($_POST['submit'])) {
            update_option('automationhub_api_url', sanitize_text_field($_POST['api_url']));
            update_option('automationhub_api_key', sanitize_text_field($_POST['api_key']));
            echo '<div class="notice notice-success"><p>Settings saved!</p></div>';
        }
        
        $api_url = get_option('automationhub_api_url', 'https://alldataflow.com/api');
        $api_key = get_option('automationhub_api_key', '');
        ?>
        <div class="wrap">
            <h1>AutomationHub Settings</h1>
            <form method="post" action="">
                <table class="form-table">
                    <tr>
                        <th scope="row">API Base URL</th>
                        <td>
                            <input type="url" name="api_url" value="<?php echo esc_attr($api_url); ?>" class="regular-text" />
                            <p class="description">Enter your AutomationHub API base URL (e.g., https://alldataflow.com/api)</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">API Key</th>
                        <td>
                            <input type="text" name="api_key" value="<?php echo esc_attr($api_key); ?>" class="regular-text" />
                            <p class="description">Optional: Enter your API key if authentication is required</p>
                        </td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
            
            <hr>
            
            <h2>Connection Test</h2>
            <button type="button" id="test-connection" class="button">Test API Connection</button>
            <div id="connection-result"></div>
        </div>
        <?php
    }
    
    public function health_shortcode($atts) {
        $atts = shortcode_atts(array(
            'show_details' => 'true'
        ), $atts);
        
        ob_start();
        ?>
        <div id="automationhub-health" class="automationhub-widget">
            <h3>AutomationHub Status</h3>
            <div class="health-status">
                <span class="status-indicator" id="status-indicator">Checking...</span>
                <span class="status-text" id="status-text">Connecting to AutomationHub API...</span>
            </div>
            <?php if ($atts['show_details'] === 'true'): ?>
            <div class="health-details" id="health-details" style="display:none;">
                <p><strong>Service:</strong> <span id="service-name"></span></p>
                <p><strong>Version:</strong> <span id="service-version"></span></p>
                <p><strong>Last Check:</strong> <span id="last-check"></span></p>
            </div>
            <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}

// Initialize the plugin
new AutomationHubPlugin();

// Activation hook
register_activation_hook(__FILE__, function() {
    // Set default options
    add_option('automationhub_api_url', 'https://alldataflow.com/api');
    add_option('automationhub_api_key', '');
});
?>