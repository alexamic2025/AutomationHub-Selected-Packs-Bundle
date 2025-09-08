=== AutomationHub LLM Integration ===
Contributors: automationhub
Tags: automation, ai, llm, sharepoint, document-processing
Requires at least: 5.0
Tested up to: 6.3
Stable tag: 1.0.0
License: GPLv2 or later

Integrates WordPress with AutomationHub API for document processing, AI analysis, and SharePoint synchronization.

== Description ==

AutomationHub LLM Integration connects your WordPress site to the powerful AutomationHub API, enabling:

* **Document Processing**: Upload and process documents through AI
* **Health Monitoring**: Real-time API status monitoring
* **SharePoint Integration**: Seamless document synchronization
* **AI Analysis**: LLM-powered content analysis
* **Easy Integration**: Simple shortcodes and widgets

== Installation ==

1. Upload the plugin files to `/wp-content/plugins/automationhub-llm-integration/`
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Go to Settings > AutomationHub to configure your API settings
4. Enter your AutomationHub API URL (e.g., https://alldataflow.com/api)
5. Test the connection to ensure everything is working

== Configuration ==

### API Settings
- **API Base URL**: Your AutomationHub server URL
- **API Key**: Optional authentication key

### Default Configuration
- API URL: `https://alldataflow.com/api`
- Health Endpoint: `/health`
- Connection Timeout: 10 seconds

== Usage ==

### Shortcodes

**Health Status Widget**
```
[automationhub_health]
```
Displays real-time API health status

**Document Upload Form**
```
[automationhub_upload accept=".pdf,.docx,.txt"]
```
Provides document upload interface

== Changelog ==

= 1.0.0 =
* Initial release
* Health monitoring
* Document upload
* API integration
* Shortcode support