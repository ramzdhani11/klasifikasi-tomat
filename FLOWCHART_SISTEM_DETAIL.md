# FLOWCHART SISTEM KLASIFIKASI TOMAT - DETAIL

## 1. ALUR UMUM SISTEM (HIGH LEVEL)

```mermaid
graph TD
    A["👤 User/Admin"] -->|Akses Web| B["🌐 Laravel Web Interface<br/>(Frontend)"]
    B -->|GET /tomat/upload| C["Upload Page<br/>Form Input Gambar"]
    C -->|User Select Image| D["Preview Gambar<br/>& Validasi File"]
    D -->|Upload via AJAX<br/>POST /tomat/classify| E["📨 Laravel Backend<br/>(Controller)"]
    E -->|File Processing| F["Simpan Temp File<br/>& Validasi"]
    F -->|HTTP Request<br/>dengan File Binary| G["🐍 Flask API<br/>Python Backend"]
    G -->|Preprocessing| H["Image Decode<br/>& Resize 256x256"]
    H -->|Feature Extraction| I["Extract Color<br/>Histogram HSV"]
    I -->|Array Fitur| J["🤖 Random Forest<br/>Model"]
    J -->|Prediksi| K["Get Predictions<br/>& Probabilities"]
    K -->|JSON Response| E
    E -->|Save ke Database| L["💾 Database<br/>Predictions Table"]
    L -->|Render View| M["📊 Result Page<br/>Tampil Hasil<br/>& Confidence"]
    M -->|Display| A
```

---

## 2. ALUR DETAIL: UPLOAD & KLASIFIKASI

```mermaid
graph TD
    START["🔵 START: User Upload"] -->|Klik Upload Button| A["1️⃣ FILE INPUT VALIDATION"]
    A -->|Check File Extension| B{Format Valid?<br/>PNG, JPG, JPEG, GIF}
    B -->|No| C["❌ Error: Invalid Format"]
    C --> END1["🔴 Show Error Message"]
    B -->|Yes| D{File Size<br/> ≤ 16MB?}
    D -->|No| C
    D -->|Yes| E["2️⃣ AJAX UPLOAD PROCESS"]
    
    E -->|FormData + File| F["Send POST /tomat/classify"]
    F --> G["3️⃣ LARAVEL BACKEND PROCESSING"]
    
    G --> H["Receive File Upload"]
    H --> I["Validate File Integrity"]
    I --> J["Temporary Save File"]
    J --> K["Prepare Request Body"]
    
    K --> L["4️⃣ PYTHON BACKEND REQUEST"]
    L -->|HTTP POST + File Binary| M["Flask App.py Receive"]
    M --> N["Parse File Stream"]
    
    N --> O["5️⃣ IMAGE PREPROCESSING"]
    O -->|cv2.imdecode| P["Decode Image dari Bytes"]
    P -->|Check Dimension| Q{Image Size<br/>256x256?}
    Q -->|No| R["cv2.resize → 256x256"]
    Q -->|Yes| S["Use As-Is"]
    R --> T["6️⃣ FEATURE EXTRACTION"]
    S --> T
    
    T -->|cv2.cvtColor| U["Convert BGR → HSV"]
    U --> V["Calculate Histogram<br/>8x8x8 bins per channel"]
    V --> W["Normalize Histogram"]
    W --> X["Concatenate Features<br/>into 1D Array"]
    X --> Y["Total Features: 192"]
    
    Y --> Z["7️⃣ MODEL PREDICTION"]
    Z -->|Loaded Model| AA["Random Forest<br/>Classifier"]
    AA -->|predict_proba| AB["Calculate Confidence<br/>for Each Class"]
    AB --> AC{Prediction<br/>Results}
    AC -->|Matang| AD["Kelas: MATANG"]
    AC -->|Mentah| AE["Kelas: MENTAH"]
    AC -->|Setengah Matang| AF["Kelas: SETENGAH_MATANG"]
    
    AD --> AG["8️⃣ PACKAGE RESPONSE"]
    AE --> AG
    AF --> AG
    AG -->|JSON Format| AH["Return:<br/>class,<br/>confidence %, <br/>timestamp"]
    
    AH --> AI["9️⃣ LARAVEL SAVE RESULTS"]
    AI -->|Store in DB| AJ["Predictions Table:<br/>user_id, filename,<br/>class, confidence,<br/>created_at"]
    
    AJ --> AK["🔟 RENDER RESULTS"]
    AK -->|JSON Response| AL["JavaScript:<br/>Update DOM"]
    AL --> AM["Display Result Card:<br/>Class, Confidence %,<br/>Advice Text"]
    AM --> AN["Show History Link"]
    AN --> END2["✅ COMPLETE"]
```

---

## 3. ALUR DATABASE & STORAGE

```mermaid
graph TD
    A["Upload Image"] --> B["Store in Public Storage"]
    B --> C["storage/app/uploads/"]
    B --> D["Temporary Processing"]
    
    D --> E["Classification Process"]
    E --> F["✅ Success?"]
    
    F -->|Yes| G["Save Prediction Record"]
    G --> H["Database: predictions table"]
    H --> I["Fields:<br/>user_id,<br/>image_filename,<br/>predicted_class,<br/>confidence_score,<br/>created_at"]
    
    F -->|No| J["Log Error"]
    J --> K["Cleanup Temp Files"]
    K --> L["Show Error to User"]
    
    I --> M["Save Image<br/>to Dataset Folder"]
    M --> N{Class Type}
    N -->|Matang| O["matang/"]
    N -->|Mentah| P["mentah/"]
    N -->|Setengah| Q["setengah_matang/"]
    O --> R["Store Correctly<br/>Classified Image"]
    P --> R
    Q --> R
```

---

## 4. ALUR ADMIN DASHBOARD

```mermaid
graph TD
    A["👨‍💼 Admin Login"] --> B["Verify Credentials"]
    B -->|Check Database| C{Credentials<br/>Valid?}
    C -->|No| D["❌ Redirect to Login"]
    C -->|Yes| E["✅ Create Session"]
    E --> F["Admin Dashboard"]
    
    F --> G["7 Main Features"]
    
    G --> H["1. Dashboard Overview"]
    H --> H1["Stats Cards:<br/>Total Predictions,<br/>Accuracy Rate,<br/>Today Predictions"]
    
    G --> I["2. Classification History"]
    I --> I1["Display All Predictions<br/>with Filter & Search"]
    
    G --> J["3. System Statistics"]
    J --> J1["Charts & Graphs:<br/>Prediction Distribution,<br/>Confidence Trends"]
    
    G --> K["4. Manage Admin Users"]
    K --> K1["CRUD Operations:<br/>Add/Edit/Delete<br/>Admin Accounts"]
    
    G --> L["5. Model Information"]
    L --> L1["Display:<br/>Model Type,<br/>Classes,<br/>Features Count"]
    
    G --> M["6. System Status"]
    M --> M1["Check:<br/>Flask Service Status,<br/>Database Status,<br/>Storage Status"]
    
    G --> N["7. Logout"]
    N --> N1["Clear Session<br/>Redirect to Login"]
```

---

## 5. ALUR AUTENTIKASI ADMIN

```mermaid
graph TD
    A["User Input:<br/>Username &<br/>Password"] --> B["POST /admin/login"]
    B --> C["Laravel: UploadController"]
    C --> D["Query Database:<br/>Users Table"]
    D --> E{User<br/>Found?}
    
    E -->|No| F["❌ Invalid Username"]
    F --> G["Redirect Login +<br/>Error Message"]
    
    E -->|Yes| H{Password<br/>Match?}
    H -->|No| F
    H -->|Yes| I{User Status<br/>= Active?}
    
    I -->|No| J["❌ Account Inactive"]
    J --> G
    
    I -->|Yes| K["✅ Authentication Success"]
    K --> L["Create Session:<br/>admin_logged_in=true,<br/>admin_user_id,<br/>admin_name"]
    L --> M["Redirect to<br/>Admin Dashboard"]
    M --> N["Display Welcome Message"]
```

---

## 6. ALUR MODEL TRAINING (Background Process)

```mermaid
graph TD
    A["Start: create_model.py"] --> B["Load Dataset"]
    B --> C["Scan Folders:<br/>matang/,<br/>mentah/,<br/>setengah_matang/"]
    
    C --> D["For Each Image"]
    D --> E["Read Image (cv2)"]
    E --> F["Extract HSV<br/>Histogram Features"]
    F --> G["Store Features +<br/>Label"]
    G --> H{All Images<br/>Processed?}
    
    H -->|No| D
    H -->|Yes| I["Combine All Features<br/>into Matrix (N, 192)"]
    
    I --> J["Train-Test Split<br/>80/20"]
    J --> K["Train Random Forest<br/>Classifier"]
    K --> L["Model Training"]
    L --> M["Extract Class Labels<br/>via LabelEncoder"]
    
    M --> N["Evaluate Model:<br/>- Predictions<br/>- Accuracy<br/>- Classification Report<br/>- Confusion Matrix"]
    
    N --> O["Save Artifacts"]
    O --> P["model_tomat.pkl"]
    O --> Q["model_tomat_encoder.pkl"]
    O --> R["model_tomat_metadata.pkl"]
    
    P --> S["Ready for<br/>Production"]
    Q --> S
    R --> S
```

---

## 7. ALUR REQUEST-RESPONSE API PYTHON

```mermaid
graph TD
    A["Request dari Laravel<br/>POST /api/predict"] -->|Multipart FormData| B["Flask App Receive"]
    
    B --> C["Check Headers:<br/>Content-Type: multipart/form-data"]
    C --> D{File dalam<br/>Request?}
    
    D -->|No| E["❌ Error 400"]
    E --> E1["Return JSON:<br/>error: 'No file provided'"]
    
    D -->|Yes| F["Parse File Object<br/>from request.files"]
    F --> G{File Extension<br/>Valid?}
    
    G -->|No| H["❌ Error 400"]
    H --> H1["Return JSON:<br/>error: 'Invalid file type'"]
    
    G -->|Yes| I["Load Model<br/>(if not loaded)"]
    I --> J["Preprocess Image<br/>(decode, resize)"]
    J --> K["Extract Features<br/>(HSV Histogram)"]
    
    K --> L["Check Features<br/>Null?"]
    L -->|Yes| M["❌ Error 500"]
    M --> M1["Return JSON:<br/>error: 'Feature extraction failed'"]
    
    L -->|No| N["Run Prediction"]
    N --> O["Get Class Label<br/>Get Probabilities"]
    
    O --> P["Build Response JSON:<br/>{'class': 'matang',<br/>'confidence': 0.95,<br/>'timestamp': 'xxx'}"]
    
    P --> Q["Return 200 OK +<br/>JSON Response"]
    Q --> R["Back to Laravel"]
```

---

## 8. ALUR LAYERS ARSITEKTUR

```mermaid
graph LR
    A["PRESENTATION LAYER<br/>🎨"] --> B["HTML/CSS/JS<br/>Templates Blade"]
    B --> C["BUSINESS LOGIC LAYER<br/>⚙️"]
    
    C --> D["Laravel Controllers<br/>Route Handlers<br/>Validation"]
    D --> E["DATA ACCESS LAYER<br/>💾"]
    
    E --> F["Database<br/>Queries"]
    F --> G["External Services<br/>🔌"]
    G --> H["Flask API<br/>Python ML Backend"]
    H --> I["ML ENGINE LAYER<br/>🤖"]
    I --> J["Model Loading<br/>Feature Extraction<br/>Prediction"]
    
    J --> K["Model Files<br/>.pkl files"]
    K --> L["DATA LAYER<br/>💿"]
    L --> M["Datasets<br/>Database<br/>Storage"]
```

---

## 9. ALUR VALIDASI & ERROR HANDLING

```mermaid
graph TD
    A["Input Data"] --> B{Step 1:<br/>File Upload<br/>Validation}
    
    B -->|Extension Check| B1{"✓ Valid<br/>Format?"}
    B1 -->|No| B2["❌ Extension Error"]
    
    B1 -->|Yes| B3{"✓ File Size<br/>≤ 16MB?"}
    B3 -->|No| B4["❌ Size Error"]
    
    B3 -->|Yes| B5["✅ Pass Upload Validation"]
    
    B5 --> C{Step 2:<br/>Image Processing<br/>Validation}
    
    C -->|Decode Check| C1{"✓ Can Decode<br/>Image?"}
    C1 -->|No| C2["❌ Corrupt Image Error"]
    
    C1 -->|Yes| C3{"✓ Valid<br/>Dimensions?"}
    C3 -->|No| C4["Auto Resize<br/>to 256x256"]
    
    C4 --> C5["✅ Pass Processing Validation"]
    
    C5 --> D{Step 3:<br/>Feature Extraction<br/>Validation}
    
    D -->|Extract Check| D1{"✓ Features<br/>Not Null?"}
    D1 -->|No| D2["❌ Feature Extraction Error"]
    
    D1 -->|Yes| D3{"✓ Feature<br/>Shape = 192?"}
    D3 -->|No| D4["❌ Feature Shape Error"]
    
    D3 -->|Yes| D5["✅ Pass Feature Validation"]
    
    D5 --> E{Step 4:<br/>Prediction<br/>Validation}
    
    E -->|Predict Check| E1{"✓ Model<br/>Loaded?"}
    E1 -->|No| E2["❌ Model Not Found Error"]
    
    E1 -->|Yes| E3{"✓ Prediction<br/>Success?"}
    E3 -->|No| E4["❌ Prediction Error"]
    
    E3 -->|Yes| E5["✅ All Validations Passed"]
    E5 --> F["Return Success Response"]
    
    B2 --> G["Return Error 400"]
    B4 --> G
    C2 --> H["Return Error 500"]
    D2 --> H
    D4 --> H
    E2 --> H
    E4 --> H
    C2 --> G
    G --> I["Show Error UI"]
    H --> I
```

---

## 10. ALUR INTERAKSI USER-SISTEM

```mermaid
sequenceDiagram
    participant User as 👤 User
    participant Web as 🌐 Laravel<br/>Frontend
    participant Laravel as ⚙️ Laravel<br/>Backend
    participant Flask as 🐍 Flask<br/>Backend
    participant DB as 💾 Database
    participant Model as 🤖 ML Model

    User->>Web: Kunjungi /tomat/upload
    Web-->>User: Tampilkan upload page
    
    User->>Web: Pilih & upload gambar
    Web->>Web: Validasi file di browser
    
    User->>Web: Klik "Klasifikasi" button
    Web->>Laravel: POST /tomat/classify + file
    
    Laravel->>Laravel: Validasi file
    Laravel->>Flask: HTTP POST dengan file binary
    
    Flask->>Flask: Decode image
    Flask->>Flask: Resize 256x256 (if needed)
    Flask->>Flask: Extract HSV histogram
    Flask->>Model: Load trained model
    Model->>Model: predict_proba([features])
    Model-->>Flask: [class, confidence]
    
    Flask-->>Laravel: JSON response
    
    Laravel->>DB: INSERT prediction record
    DB-->>Laravel: ID saved
    
    Laravel-->>Web: JSON response
    Web->>Web: Parse results
    Web->>User: Display result card
    
    User->>User: Lihat hasil & confidence %
```

---

## 11. ALUR DATABASE SCHEMA

```mermaid
graph TD
    A["📊 DATABASE SCHEMA"]
    
    A --> B["users table"]
    B --> B1["id: PK"]
    B1 --> B2["email: VARCHAR"]
    B2 --> B3["username: VARCHAR"]
    B3 --> B4["password: VARCHAR hash"]
    B4 --> B5["name: VARCHAR"]
    B5 --> B6["status: ENUM active/inactive"]
    B6 --> B7["created_at, updated_at"]
    
    A --> C["predictions table"]
    C --> C1["id: PK"]
    C1 --> C2["user_id: FK to users"]
    C2 --> C3["image_filename: VARCHAR"]
    C3 --> C4["predicted_class: ENUM matang/mentah/setengah_matang"]
    C4 --> C5["confidence_score: DECIMAL 0.00-1.00"]
    C5 --> C6["created_at, updated_at"]
    
    A --> D["uploads table (legacy)"]
    D --> D1["id: PK"]
    D1 --> D2["user_id: FK"]
    D2 --> D3["image_file: VARCHAR path"]
    D3 --> D4["classification_result: VARCHAR"]
    D4 --> D5["created_at, updated_at"]
```

---

## 12. ALUR CACHE & PERFORMANCE

```mermaid
graph TD
    A["Request Classification"] --> B{"Is Model<br/>Loaded in<br/>Memory?"}
    
    B -->|No| C["Load from<br/>model_tomat.pkl"]
    C --> D["Cache in<br/>Global Variable"]
    D --> E["Store in Memory"]
    
    B -->|Yes| F["Use Cached<br/>Model"]
    
    E --> G["Process Image"]
    F --> G
    
    G --> H["Extract Features"]
    H --> I["Run Prediction"]
    I --> J["Return Result"]
    
    J --> K["Total Time:<br/>~500-800ms<br/>(with optimization)"]
```

---

## 13. ALUR DEPLOYMENT & SETUP

```mermaid
graph TD
    A["DEPLOYMENT WORKFLOW"]
    
    A --> B["1. Setup Laravel"]
    B --> B1["composer install"]
    B1 --> B2[".env configuration"]
    B2 --> B3["php artisan migrate"]
    
    A --> C["2. Setup Python ML Backend"]
    C --> C1["pip install requirements"]
    C1 --> C2["python create_model.py<br/>(train model)"]
    C2 --> C3["Generate model_tomat.pkl"]
    
    A --> D["3. Create Directories"]
    D --> D1["storage/app/uploads/"]
    D1 --> D2["matang/"]
    D1 --> D3["mentah/"]
    D1 --> D4["setengah_matang/"]
    
    A --> E["4. Start Services"]
    E --> E1["npm run dev (Frontend)"]
    E1 --> E2["php artisan serve (Laravel)"]
    E2 --> E3["python app.py (Flask)"]
    E3 --> E4["✅ System Running"]
```

---

## 14. ALUR FITUR EKSTRAKSI (DETAIL TEKNIS)

```mermaid
graph TD
    A["Input: Image BGR<br/>256x256x3"] --> B["Step 1: Color Space<br/>Conversion"]
    
    B --> C["cv2.cvtColor<br/>BGR → HSV"]
    C --> D["Output: Image HSV<br/>256x256x3"]
    
    D --> E["Step 2: Histogram<br/>Extraction"]
    
    E --> F["Channel 0: Hue"]
    F --> F1["cv2.calcHist<br/>bins=8"]
    F1 --> F2["Normalized Histogram<br/>shape: 8"]
    
    E --> G["Channel 1: Saturation"]
    G --> G1["cv2.calcHist<br/>bins=8"]
    G1 --> G2["Normalized Histogram<br/>shape: 8"]
    
    E --> H["Channel 2: Value"]
    H --> H1["cv2.calcHist<br/>bins=8"]
    H1 --> H2["Normalized Histogram<br/>shape: 8"]
    
    F2 --> I["Step 3: Concatenate"]
    G2 --> I
    H2 --> I
    
    I --> J["Final Feature Vector<br/>shape: 192<br/>(8+8+8)×3"]
    
    J --> K["Input to Model:<br/>X_test.shape = (1, 192)"]
```

---

# RINGKASAN KOMPONEN SISTEM

| Komponen | Teknologi | Fungsi |
|----------|-----------|--------|
| Frontend | HTML/CSS/JS, Blade Template | User Interface, Upload Form |
| Backend Web | Laravel 11 | API, Database, Authentication |
| Backend ML | Flask, Python | Image Processing, Prediction |
| Model | Random Forest, joblib | Classification |
| Database | SQLite/MySQL | Store predictions, users |
| Features | HSV Histogram | Color-based classification |
| Classes | 3 (Matang, Mentah, Setengah Matang) | Tomato ripeness levels |

---

# TEKNOLOGI STACK

```
🎨 Frontend:
   └─ HTML5 / CSS3 / JavaScript (Vanilla)
   └─ Alpine.js (optional)
   └─ Blade Templating Engine

⚙️ Backend Web:
   └─ PHP 8.x
   └─ Laravel 11
   └─ Eloquent ORM
   └─ Laravel Routes & Controllers

🐍 Backend ML:
   └─ Python 3.8+
   └─ Flask (API Server)
   └─ OpenCV (cv2)
   └─ scikit-learn (ML)
   └─ NumPy (Numerical)
   └─ joblib (Model persistence)

💾 Database:
   └─ MySQL / SQLite
   └─ Migrations for versioning

📦 Deployment:
   └─ Apache / Nginx (Laravel)
   └─ Gunicorn / uWSGI (Flask)
```
