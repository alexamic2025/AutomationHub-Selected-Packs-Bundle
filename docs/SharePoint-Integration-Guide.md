# 🔗 SharePoint Integration Setup Guide

## 🎯 **Overview**
Complete integration between AutomationHub API and Microsoft SharePoint Online for document processing and workflow automation.

## 📋 **Prerequisites**

### **Required Access**
- ✅ **Microsoft 365 Admin** access
- ✅ **SharePoint Online** license
- ✅ **Power Automate** license
- ✅ **AutomationHub API** running at https://alldataflow.com/api/

### **Required Information**
- SharePoint site URL
- Document library names
- User permissions
- API authentication (if required)

---

## 📁 **Step 1: SharePoint Lists Setup**

### **Create Document Processing List**
1. **Navigate** to your SharePoint site
2. **Create New List:** "AutomationHub Document Queue"
3. **Add Columns:**
   - `Document Name` (Single line text)
   - `Upload Date` (Date and time)
   - `Processing Status` (Choice: Pending, Processing, Complete, Error)
   - `API Response` (Multiple lines of text)
   - `Document URL` (Hyperlink)
   - `Processed By` (Person)

### **Create Results Library**
1. **Create Document Library:** "AutomationHub Results"
2. **Add Metadata Columns:**
   - `Source Document` (Single line text)
   - `Processing Date` (Date and time)
   - `AI Analysis Result` (Multiple lines of text)
   - `Status` (Choice: Success, Failed, Partial)

---

## ⚙️ **Step 2: Power Automate Flow Setup**

### **Flow 1: Document Upload Trigger**
```
Trigger: When a file is created in SharePoint
↓
Action: HTTP POST to AutomationHub API
↓
Action: Update list item with API response
↓
Action: Send notification (Teams/Email)
```

**HTTP Action Configuration:**
- **URL:** `https://alldataflow.com/api/document/process`
- **Method:** POST
- **Headers:** `Content-Type: application/json`
- **Body:** 
```json
{
  "documentName": "@{triggerOutputs()?['body/Name']}",
  "documentUrl": "@{triggerOutputs()?['body/{Link}']}",
  "uploadedBy": "@{triggerOutputs()?['body/Author/DisplayName']}"
}
```

### **Flow 2: Health Check Monitoring**
```
Trigger: Recurrence (every 15 minutes)
↓
Action: HTTP GET to AutomationHub health endpoint
↓
Condition: Check if API is healthy
↓
Action: Log status to SharePoint list
↓
Action: Send alert if unhealthy
```

**Health Check Configuration:**
- **URL:** `https://alldataflow.com/api/health`
- **Method:** GET
- **Expected Response:** `{"status":"healthy"}`

---

## 🔔 **Step 3: Teams Integration**

### **Create Teams Channel**
1. **Channel Name:** "AutomationHub Notifications"
2. **Purpose:** API status and document processing alerts

### **Teams Connector Setup**
1. **Add Connector** to Teams channel
2. **Configure Webhook** URL in Power Automate
3. **Test Connection** with sample message

### **Notification Templates**

**Document Processed Successfully:**
```
🟢 **Document Processed**
📄 **File:** {{DocumentName}}
⏰ **Time:** {{ProcessingTime}}
✅ **Status:** Complete
🔗 **Results:** {{ResultsLink}}
```

**API Health Alert:**
```
🔴 **AutomationHub Alert**
⚠️ **Issue:** API health check failed
🕐 **Time:** {{CurrentTime}}
🔗 **Endpoint:** https://alldataflow.com/api/health
👨‍💻 **Action Required:** Check API status
```

---

## 🧪 **Step 4: Testing Integration**

### **Test Document Upload**
1. **Upload Test Document** to SharePoint library
2. **Verify Power Automate** flow triggers
3. **Check API Response** in SharePoint list
4. **Confirm Teams Notification** received

### **Test Health Monitoring**
1. **Manual Trigger** health check flow
2. **Verify API Response** logged
3. **Check Alert System** (temporarily stop API)

### **Expected Results**
```json
// API Health Response
{
  "status": "healthy",
  "timestamp": "2025-09-08T00:00:40.141Z",
  "service": "AutomationHub API",
  "version": "1.0.0"
}
```

---

## 📊 **Step 5: Monitoring Dashboard**

### **SharePoint Dashboard Page**
Create a SharePoint page with:
- **API Status Widget** (latest health check)
- **Document Processing Queue** (pending items)
- **Recent Activity** (last 10 processed documents)
- **Performance Metrics** (success rate, avg. processing time)

### **Power BI Integration**
Connect Power BI to SharePoint lists for:
- Processing volume trends
- Success/failure rates
- API uptime statistics
- User activity analytics

---

## 🔧 **Advanced Configuration**

### **API Authentication** (if required)
```json
// Headers for authenticated requests
{
  "Authorization": "Bearer YOUR_API_TOKEN",
  "Content-Type": "application/json"
}
```

### **Error Handling**
```
Try:
  HTTP Request to API
Catch:
  Log error to SharePoint
  Send alert to Teams
  Set document status to "Error"
```

### **Batch Processing**
For high-volume scenarios:
- **Batch Size:** 10 documents
- **Processing Delay:** 5 seconds between batches
- **Retry Logic:** 3 attempts with exponential backoff

---

## ✅ **Verification Checklist**

### **SharePoint Setup**
- [ ] Document processing list created
- [ ] Results library configured
- [ ] Permissions set correctly
- [ ] Metadata columns added

### **Power Automate**
- [ ] Document upload flow active
- [ ] Health monitoring flow scheduled
- [ ] Error handling configured
- [ ] Testing completed successfully

### **Teams Integration**
- [ ] Channel created
- [ ] Connector configured
- [ ] Notifications working
- [ ] Alert system tested

### **API Connectivity**
- [ ] Health endpoint accessible
- [ ] Document processing endpoint tested
- [ ] Authentication working (if required)
- [ ] Response handling correct

---

## 🎯 **Success Metrics**

**After Setup, You Should Have:**
- ✅ **Automatic document processing** on SharePoint upload
- ✅ **Real-time API health monitoring** 
- ✅ **Teams notifications** for all activities
- ✅ **Complete audit trail** in SharePoint lists
- ✅ **Dashboard visibility** of all operations

**🎉 SharePoint integration complete - your document workflow is now fully automated!**