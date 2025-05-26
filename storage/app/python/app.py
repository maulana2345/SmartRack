from flask import Flask, request, jsonify
import pandas as pd
# from sklearn.tree import DecisionTreeClassifier
# import random
# import json

app = Flask(__name__)

@app.route('/api/rekomendasi', methods=['POST'])
def rekomendasi():
    data = request.json

    kode_barang = data.get('kode_barang')
    kategori = data.get('kategori', 'fast').lower()
    stock = int(data.get('stock', 0))
    total_dimensi = int(data.get('total_dimensi', 0))
    rak_list = data.get('rak_list', [])

    print(">>> KODE BARANG:", kode_barang)
    print(">>> KATEGORI:", kategori)
    print(">>> STOCK:", stock)
    print(">>> TOTAL DIMENSI:", total_dimensi)
    print(">>> TOTAL RAK MASUK:", len(rak_list))

    if kategori not in ['fast', 'slow']:
        return jsonify({'error': "Kategori harus 'fast' atau 'slow'"}), 400
    if not kode_barang or stock <= 0 or total_dimensi <= 0 or not rak_list:
        return jsonify({'error': 'Data tidak lengkap'}), 400

    df_rak = pd.DataFrame(rak_list)

    # Pastikan kolom jarak numerik
    df_rak['jarak'] = pd.to_numeric(df_rak['jarak'], errors='coerce')

    # Filter rak yang kapasitas tersedia >= total dimensi barang
    df_valid = df_rak[df_rak['kapasitas_tersedia'] >= total_dimensi]

    print(">>> RAK YANG VALID:", df_valid[['kode_rak', 'jarak', 'kapasitas_tersedia']].to_dict(orient='records'))

    if df_valid.empty:
        return jsonify({'recommended_rak': 'NOT_FOUND'})

    if kategori == 'fast':
        # fast: cari yang paling dekat (jarak kecil)
        df_sorted = df_valid.sort_values(by=['jarak', 'kapasitas_tersedia'], ascending=[True, False])
    else:
        # slow: cari yang paling jauh (jarak besar)
        df_sorted = df_valid.sort_values(by=['jarak', 'kapasitas_tersedia'], ascending=[False, False])

    print(">>> RAK YANG DIPILIH:", df_sorted.iloc[0].to_dict())

    return jsonify({'recommended_rak': df_sorted.iloc[0]['kode_rak']})

if __name__ == '__main__':
    app.run(debug=True, port=5000)