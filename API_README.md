# Tomat Classification API

API Flask untuk klasifikasi tingkat kematangan tomat menggunakan Random Forest dan Color Histogram RGB.

## Fitur

- **Preprocessing**: Resize gambar ke 256x256
- **Ekstraksi Fitur**: Color Histogram RGB (8x8x8 bins)
- **Klasifikasi**: Random Forest dengan 3 kelas
- **Format Output**: JSON dengan probabilitas dan confidence score

## Kelas Output

- `matang` - Tomat sudah matang
- `mentah` - Tomat masih mentah  
- `setengah_matang` - Tomat setengah matang

## Endpoint

### 1. Health Check
```
GET /health
```

Response:
```json
{
  "status": "healthy",
  "model_loaded": true,
  "service": "Tomat Classification API"
}
```

### 2. Prediksi
```
POST /predict
Content-Type: multipart/form-data
```

**Request**: Upload file gambar dengan key `image`

**Response**:
```json
{
  "success": true,
  "prediction": {
    "class": "matang",
    "confidence": 0.85,
    "confidence_percentage": 85.0,
    "probabilities": {
      "matang": {"probability": 0.85, "percentage": 85.0},
      "mentah": {"probability": 0.10, "percentage": 10.0},
      "setengah_matang": {"probability": 0.05, "percentage": 5.0}
    }
  },
  "metadata": {
    "model_type": "RandomForest",
    "features_used": 24,
    "image_processed": "tomat.jpg"
  }
}
```

### 3. Informasi Model
```
GET /info
```

Response:
```json
{
  "success": true,
  "model_info": {
    "type": "RandomForestClassifier",
    "classes": ["matang", "mentah", "setengah_matang"],
    "n_features": 24,
    "n_estimators": 100
  },
  "api_info": {
    "version": "1.0.0",
    "endpoints": {
      "health": "/health",
      "predict": "/predict (POST)",
      "info": "/info"
    },
    "supported_formats": ["PNG", "JPG", "JPEG"],
    "max_file_size": "16MB"
  }
}
```

## Cara Menjalankan

### 1. Install Dependencies
```bash
pip install flask opencv-python numpy scikit-learn joblib
```

### 2. Training Model (Opsional)
```bash
python main.py
```
Ini akan membuat folder `models/` dengan file model yang sudah trained.

### 3. Jalankan API
```bash
python app.py
```

Server akan berjalan di: `http://127.0.0.1:5000`

## Cara Testing API

### Menggunakan curl
```bash
# Health check
curl http://127.0.0.1:5000/health

# Prediksi gambar
curl -X POST -F "image=@path/to/gambar.jpg" http://127.0.0.1:5000/predict

# Info model
curl http://127.0.0.1:5000/info
```

### Menggunakan Python
```python
import requests

# Health check
response = requests.get('http://127.0.0.1:5000/health')
print(response.json())

# Prediksi gambar
with open('gambar_tomat.jpg', 'rb') as f:
    files = {'image': f}
    response = requests.post('http://127.0.0.1:5000/predict', files=files)
    print(response.json())
```

## Struktur File

```
data_tomat/
  app.py                    # Flask API
  main.py                   # Training model
  models/                   # Folder model
    tomat_classifier.pkl    # Model Random Forest
    label_encoder.pkl       # Label encoder
    metadata.pkl            # Metadata model
  matang/                   # Folder gambar matang
  mentah/                   # Folder gambar mentah
  setengah_matang/          # Folder gambar setengah matang
```

## Error Handling

API mengembalikan error response dengan format:
```json
{
  "success": false,
  "error": "Error type",
  "message": "Detailed error message"
}
```

### Common Errors
- **400**: File tidak ada, format tidak didukung, processing gagal
- **413**: File terlalu besar (>16MB)
- **500**: Internal server error

## Notes

- API akan otomatis membuat model dummy jika file model belum ada
- Untuk hasil prediksi yang akurat, jalankan `python main.py` terlebih dahulu
- File temporary akan otomatis dihapus setelah processing
- Gambar akan di-resize ke 256x256 sebelum ekstraksi fitur

## Dependencies

- Flask 2.0+
- OpenCV 4.0+
- NumPy 1.19+
- Scikit-learn 1.0+
- Joblib 1.0+
