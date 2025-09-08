# 📦 WordPress Plugin Installation Guide

## 🎯 **Quick Install: 2-Minute Setup**

### **Step 1: Download Plugin**
Download from GitHub: `wordpress-plugin/` folder or zip the files locally

### **Step 2: Install in WordPress**
1. **WordPress Admin** → **Plugins** → **Add New** → **Upload Plugin**
2. **Upload** the plugin zip file
3. **Activate** the plugin
4. **Configure** API settings

### **Step 3: Configure API**
1. Go to **Settings** → **AutomationHub**
2. **API Base URL**: `https://alldataflow.com/api`
3. **Test Connection** to verify

## ⚙️ **Configuration Details**

### **Default Settings**
```
API Base URL: https://alldataflow.com/api
Health Endpoint: /health
Connection Timeout: 10 seconds
```

### **Plugin Features**
- ✅ **Health Status Monitoring**
- ✅ **Document Upload Interface** 
- ✅ **API Connection Testing**
- ✅ **Real-time Status Widgets**
- ✅ **Shortcode Support**

## 🎨 **Using Shortcodes**

### **Health Status Widget**
```
[automationhub_health]
```
**Displays:** Real-time API health with status indicator

### **Document Upload Form**
```
[automationhub_upload accept=".pdf,.docx,.txt"]
```
**Provides:** Upload interface for document processing

## 🧪 **Testing the Integration**

### **Admin Panel Test**
1. **Settings** → **AutomationHub**
2. Click **"Test API Connection"**
3. **Expected Result:**
```json
{
  "status": "healthy",
  "timestamp": "2025-09-08T00:00:40.141Z",
  "service": "AutomationHub API",
  "version": "1.0.0"
}
```

### **Frontend Test**
Add `[automationhub_health]` to any page/post to see live status

## 🔧 **Troubleshooting**

### **Connection Issues**
- ✅ Verify API URL: `https://alldataflow.com/api/health`
- ✅ Check plugin activation
- ✅ Test direct API access

### **Common Solutions**
1. **Clear cache** after plugin activation
2. **Check WordPress permissions**
3. **Verify API endpoint** is accessible
4. **Update API URL** in plugin settings

## 📊 **Plugin Status Dashboard**

Once installed, you'll see:
- 🟢 **Green Status**: API healthy and connected
- 🔴 **Red Status**: Connection issues
- ⚪ **Gray Status**: Checking connection

---

**✅ Ready to install? The plugin is production-ready and pre-configured for your AutomationHub API!**