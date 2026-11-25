import React, { useState, useEffect } from 'react';
import axios from 'axios';

const getStatusTheme = (status = '') => {
  const normalized = status.toLowerCase();

  if (normalized.includes('disalurkan') || normalized.includes('selesai')) {
    return {
      label: 'Selesai Disalurkan',
      badge: 'bg-emerald-50 text-emerald-700 border-emerald-200',
      dot: 'bg-emerald-500',
    };
  }

  if (normalized.includes('diproses') || normalized.includes('tersedia')) {
    return {
      label: 'Diproses / Siap',
      badge: 'bg-blue-50 text-blue-700 border-blue-200',
      dot: 'bg-blue-500',
    };
  }

  return {
    label: 'Menunggu Verifikasi',
    badge: 'bg-amber-50 text-amber-700 border-amber-200',
    dot: 'bg-amber-500',
  };
};

export default function DonationHistory() {
  const [donations, setDonations] = useState([]);
  const [statusFilter, setStatusFilter] = useState('semua');
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchHistory = async () => {
      try {
        setLoading(true);
        setError(null);
        const response = await axios.get('/api/my-donations', {
          params: { status: statusFilter },
        });
        setDonations(response.data.data || []);
      } catch (err) {
        setError(err.response?.data?.message || 'Gagal memuat data riwayat donasi.');
      } finally {
        setLoading(false);
      }
    };

    fetchHistory();
  }, [statusFilter]);

  const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('id-ID', {
      day: 'numeric',
      month: 'long',
      year: 'numeric',
    });
  };

  const filterTabs = [
    { key: 'semua', label: 'Semua' },
    { key: 'menunggu', label: 'Menunggu' },
    { key: 'diproses', label: 'Diproses' },
    { key: 'selesai', label: 'Selesai' },
  ];

  return (
    <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
      {/* Header Halaman */}
      <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-6 border-b border-slate-200 mb-6 gap-4">
        <div>
          <h1 className="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
            Riwayat Donasi Saya
          </h1>
          <p className="text-sm text-slate-500 mt-1">
            Daftar seluruh kontribusi barang yang telah Anda serahkan untuk pendidikan.
          </p>
        </div>
        <a
          href="/items/create"
          className="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm rounded-xl shadow-md transition-all"
        >
          + Posting Donasi Baru
        </a>
      </div>

      {/* Tab Filter Status */}
      <div className="flex flex-wrap items-center gap-2 mb-6">
        {filterTabs.map((tab) => {
          const isActive = statusFilter === tab.key;
          return (
            <button
              key={tab.key}
              type="button"
              onClick={() => setStatusFilter(tab.key)}
              className={`px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition-all cursor-pointer ${
                isActive
                  ? 'bg-emerald-600 text-white shadow-sm'
                  : 'bg-slate-100 text-slate-600 hover:bg-slate-200 hover:text-slate-900'
              }`}
            >
              {tab.label}
            </button>
          );
        })}
      </div>

      {/* Loading Skeleton */}
      {loading && (
        <div className="space-y-3">
          {[1, 2, 3].map((n) => (
            <div key={n} className="h-16 bg-slate-100 rounded-xl animate-pulse" />
          ))}
        </div>
      )}

      {/* Error Alert */}
      {error && (
        <div className="p-4 bg-rose-50 border border-rose-200 text-rose-700 text-sm rounded-xl">
          {error}
        </div>
      )}

      {/* Kondisi Kosong (Empty State) */}
      {!loading && !error && donations.length === 0 && (
        <div className="text-center py-16 px-4 bg-white border border-dashed border-slate-300 rounded-3xl">
          <div className="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 mx-auto flex items-center justify-center mb-4">
            <svg className="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                strokeWidth="1.5"
                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"
              />
            </svg>
          </div>
          <h2 className="text-lg font-bold text-slate-900">Belum Ada Riwayat Donasi</h2>
          <p className="text-slate-500 text-sm max-w-sm mx-auto mt-1 mb-6">
            {statusFilter === 'semua'
              ? 'Anda belum pernah mendaftarkan donasi. Mulai langkah pertama Anda untuk membantu pendidikan anak bangsa.'
              : `Tidak ada data donasi pada kategori status "${statusFilter}".`}
          </p>
          {statusFilter === 'semua' ? (
            <a
              href="/items/create"
              className="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm rounded-xl shadow-md transition-all"
            >
              + Mulai Donasi Sekarang
            </a>
          ) : (
            <button
              type="button"
              onClick={() => setStatusFilter('semua')}
              className="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-sm rounded-xl transition-all cursor-pointer"
            >
              Lihat Semua Donasi
            </button>
          )}
        </div>
      )}

      {/* Tabel Data Riwayat */}
      {!loading && !error && donations.length > 0 && (
        <div className="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
          <div className="overflow-x-auto">
            <table className="w-full text-left text-sm text-slate-600">
              <thead className="bg-slate-50 text-slate-500 uppercase text-[11px] font-bold tracking-wider border-b border-slate-100">
                <tr>
                  <th className="px-6 py-4">Nama Barang</th>
                  <th className="px-6 py-4">Kategori</th>
                  <th className="px-6 py-4">Tanggal Donasi</th>
                  <th className="px-6 py-4">Status Penyaluran</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-slate-100">
                {donations.map((item) => {
                  const theme = getStatusTheme(item.status);
                  return (
                    <tr key={item.id} className="hover:bg-slate-50/60 transition-colors">
                      <td className="px-6 py-4 font-bold text-slate-900">{item.nama_barang}</td>
                      <td className="px-6 py-4 text-xs text-slate-500">{item.kategori}</td>
                      <td className="px-6 py-4 text-slate-500">{formatDate(item.created_at)}</td>
                      <td className="px-6 py-4">
                        <span
                          className={`inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold border ${theme.badge}`}
                        >
                          <span className={`w-1.5 h-1.5 rounded-full ${theme.dot}`} />
                          {theme.label}
                        </span>
                      </td>
                    </tr>
                  );
                })}
              </tbody>
            </table>
          </div>
        </div>
      )}
    </div>
  );
}
