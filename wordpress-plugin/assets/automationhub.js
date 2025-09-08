jQuery(document).ready(function($) {
    
    // Test connection button
    $('#test-connection').on('click', function() {
        var button = $(this);
        var result = $('#connection-result');
        
        button.prop('disabled', true).text('Testing...');
        result.html('');
        
        $.ajax({
            url: automationhub_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'automationhub_test_connection',
                nonce: automationhub_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    result.html(
                        '<div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 3px;">' +
                        '<strong>✅ Connection Successful!</strong><br>' +
                        '<pre>' + JSON.stringify(response.data, null, 2) + '</pre>' +
                        '</div>'
                    );
                } else {
                    result.html(
                        '<div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 3px;">' +
                        '<strong>❌ Connection Failed:</strong><br>' + response.data +
                        '</div>'
                    );
                }
            },
            error: function(xhr, status, error) {
                result.html(
                    '<div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 3px;">' +
                    '<strong>❌ AJAX Error:</strong><br>' + error +
                    '</div>'
                );
            },
            complete: function() {
                button.prop('disabled', false).text('Test API Connection');
            }
        });
    });
    
    // Auto-refresh health status widgets
    function refreshHealthWidgets() {
        $('.automationhub-widget #status-indicator').each(function() {
            var widget = $(this).closest('.automationhub-widget');
            checkHealthStatus(widget);
        });
    }
    
    function checkHealthStatus(widget) {
        $.ajax({
            url: automationhub_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'automationhub_test_connection',
                nonce: automationhub_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    widget.find('#status-indicator').text('🟢 Healthy').css('color', 'green');
                    widget.find('#status-text').text('AutomationHub API is running');
                    widget.find('#service-name').text(response.data.service || 'AutomationHub API');
                    widget.find('#service-version').text(response.data.version || '1.0.0');
                    widget.find('#last-check').text(new Date().toLocaleString());
                    widget.find('#health-details').show();
                }
            }
        });
    }
    
    // Auto-refresh every 30 seconds
    setInterval(refreshHealthWidgets, 30000);
    
    // Initial load
    setTimeout(refreshHealthWidgets, 1000);
});