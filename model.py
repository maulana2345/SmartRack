# model.py
import pandas as pd
import sys
import json
from sklearn.tree import DecisionTreeClassifier
import random

# ====== STEP 0: VALIDASI ARGUMEN ======
if len(sys.argv) != 5:
    print("Usage: model.py <kode_barang> <kategori> <stock> <path_json>", file=sys.stderr)
    sys.exit(1)

kode_barang = sys.argv[1]
kategori = sys.argv[2].strip().lower()
stock = int(sys.argv[3])
json_path = sys.argv[4]

if kategori not in ["fast", "slow"]:
    print("❌ Kategori harus 'fast' atau 'slow'", file=sys.stderr)
    sys.exit(1)

# ====== STEP 1: BACA DATA RAK DARI FILE JSON ======
try:
    df_rak = pd.read_json(json_path)
except Exception as e:
    print(f"❌ Gagal membaca file JSON: {e}", file=sys.stderr)
    sys.exit(1)

# ====== STEP 2: TRAINING MODEL ======
training_data = []
training_labels = []

for _ in range(300):
    k = random.choice(["fast", "slow"])
    k_enc = 0 if k == "fast" else 1
    v = random.randint(50, 1000)
    jrk = random.randint(1, 200)
    kap = random.randint(0, 1000)
    cocok = kap >= v
    training_data.append([k_enc, v, jrk, kap])
    training_labels.append(1 if cocok else 0)

model = DecisionTreeClassifier(max_depth=5, random_state=42)
model.fit(training_data, training_labels)

# ====== STEP 3: PREDIKSI RAK YANG COCOK ======
kategori_encoded = 0 if kategori == "fast" else 1

valid_rak = []
for _, rak in df_rak.iterrows():
    if rak["kapasitas_tersedia"] >= stock:
        fitur = [kategori_encoded, stock, rak["jarak"], rak["kapasitas_tersedia"]]
        cocok = model.predict([fitur])[0]
        if cocok:
            valid_rak.append(rak)

# ====== STEP 4: PRIORITAS SELEKSI ======
if kategori == "fast":
    sorted_rak = sorted(valid_rak, key=lambda x: (x["jarak"], x["kapasitas_tersedia"]))
else:
    sorted_rak = sorted(valid_rak, key=lambda x: (-x["jarak"], x["kapasitas_tersedia"]))

# ====== STEP 5: OUTPUT ======
if sorted_rak:
    print(sorted_rak[0]["kode_rak"])
else:
    print("NOT_FOUND")
