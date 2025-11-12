<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBeritaRequest;
use App\Http\Requests\StoreGaleriRequest;
use App\Http\Requests\UpdateBeritaRequest;
use App\Http\Requests\UpdateGaleriRequest;
use App\Models\AdminLog;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Layanan;
use App\Models\Pengaduan;
use App\Models\Potensi;
use App\Models\ProfilDesa;
use App\Models\StrukturPemerintahan;
use App\Models\User;
use App\Models\WelcomeContent;
use App\Models\WelcomeElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Statistik untuk dashboard
        $stats = [
            'total_berita' => Berita::count(),
            'total_layanan' => Layanan::count(),
            'total_potensi' => Potensi::count(),
            'total_galeri' => Galeri::count(),
            'total_pengaduan' => Pengaduan::count(),
            'total_admin' => User::count(),
            'pengaduan_pending' => Pengaduan::where('status', 'pending')->count(),
            'pengaduan_diproses' => Pengaduan::where('status', 'diproses')->count(),
            'pengaduan_selesai' => Pengaduan::where('status', 'selesai')->count(),
        ];

        $logs = AdminLog::latest()->take(10)->get();
        $recent_pengaduan = Pengaduan::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'logs', 'recent_pengaduan'));
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
        ]);

        $user = Auth::user();
        $user->update($request->only(['name', 'email']));

        AdminLog::create([
            'user_id' => $user->id,
            'action' => 'update_profile',
            'details' => 'Updated profile: name and email',
        ]);

        return redirect()->route('admin.profile')->with('status', 'Profil berhasil diperbarui.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        AdminLog::create([
            'user_id' => $user->id,
            'action' => 'change_password',
            'details' => 'Password changed',
        ]);

        return redirect()->route('admin.profile')->with('status', 'Password berhasil diubah.');
    }

    public function logs()
    {
        $logs = AdminLog::with('user')->paginate(20);
        return view('admin.logs', compact('logs'));
    }

    // Manajemen Admin
    public function manageAdmins()
    {
        $admins = User::paginate(10);
        return view('admin.manage-admins', compact('admins'));
    }

    public function createAdmin(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        AdminLog::create([
            'user_id' => Auth::id(),
            'action' => 'create_admin',
            'details' => 'Created new admin: ' . $admin->name,
        ]);

        return redirect()->route('admin.manage-admins')->with('status', 'Admin berhasil dibuat.');
    }

    public function deleteAdmin($id)
    {
        $admin = User::findOrFail($id);

        // Prevent deleting self
        if ($admin->id === Auth::id()) {
            return redirect()->route('admin.manage-admins')->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $admin->delete();

        AdminLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete_admin',
            'details' => 'Deleted admin: ' . $admin->name,
        ]);

        return redirect()->route('admin.manage-admins')->with('status', 'Admin berhasil dihapus.');
    }

    // Pengaduan Management
    public function pengaduan()
    {
        $pengaduan = Pengaduan::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.pengaduan', compact('pengaduan'));
    }

    public function updatePengaduanStatus(Request $request, $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,diproses,selesai',
            'tanggapan' => 'nullable|string',
        ]);

        $pengaduan->update([
            'status' => $request->status,
            'tanggapan' => $request->tanggapan,
            'tanggal_tanggapan' => $request->tanggapan ? now() : null,
        ]);

        AdminLog::create([
            'user_id' => Auth::id(),
            'action' => 'update_pengaduan',
            'details' => 'Updated pengaduan status: ' . $pengaduan->judul . ' to ' . $request->status,
        ]);

        return back()->with('success', 'Status pengaduan berhasil diperbarui.');
    }

    // Welcome Content Management
    public function editWelcome()
    {
        $welcomeContent = WelcomeContent::first();
        return view('admin.edit-welcome', compact('welcomeContent'));
    }

    public function updateWelcome(Request $request)
    {
        $request->validate([
            'village_name' => 'required|string|max:255',
            'hero_title' => 'required|string|max:255',
            'hero_description' => 'required|string',
            'hero_button_text' => 'required|string|max:255',
            'hero_button_link' => 'required|string|max:255',
            'hero_background_image' => 'nullable|string|max:500',
            'profile_title' => 'required|string|max:255',
            'profile_description' => 'required|string',
            'location_title' => 'required|string|max:255',
            'location_description' => 'required|string',
            'agriculture_title' => 'required|string|max:255',
            'agriculture_description' => 'required|string',
            'culture_title' => 'required|string|max:255',
            'culture_description' => 'required|string',
            'footer_text' => 'required|string|max:500',
        ]);

        $welcomeContent = WelcomeContent::first();
        if (!$welcomeContent) {
            $welcomeContent = new WelcomeContent();
        }

        $welcomeContent->fill($request->all());
        $welcomeContent->save();

        AdminLog::create([
            'user_id' => Auth::id(),
            'action' => 'update_welcome_content',
            'details' => 'Updated welcome page content',
        ]);

        return redirect()->route('admin.edit-welcome')->with('status', 'Konten welcome berhasil diperbarui.');
    }

    // Welcome Elements Management
    public function index()
    {
        $query = WelcomeElement::orderBy('element_type')->orderBy('sort_order');

        // Filter berdasarkan section jika ada
        if (request('section')) {
            $query->where('element_type', request('section'));
        }

        $elements = $query->paginate(15);
        return view('admin.welcome-elements.index', compact('elements'));
    }

    public function create()
    {
        $elementTypes = [
            'navbar' => 'Navbar',
            'hero' => 'Hero Section',
            'profile' => 'Profile Section',
            'location' => 'Location Card',
            'agriculture' => 'Agriculture Card',
            'culture' => 'Culture Card',
            'footer' => 'Footer',
        ];
        return view('admin.welcome-elements.create', compact('elementTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'element_type' => 'required|string',
            'element_key' => 'required|string',
            'content' => 'required|string',
            'sort_order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        WelcomeElement::create($request->all());

        AdminLog::create([
            'user_id' => Auth::id(),
            'action' => 'create_welcome_element',
            'details' => 'Created welcome element: ' . $request->element_type . '.' . $request->element_key,
        ]);

        return redirect()->route('admin.welcome-elements.index')->with('success', 'Element berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $element = WelcomeElement::findOrFail($id);
        $elementTypes = [
            'navbar' => 'Navbar',
            'hero' => 'Hero Section',
            'profile' => 'Profile Section',
            'location' => 'Location Card',
            'agriculture' => 'Agriculture Card',
            'culture' => 'Culture Card',
            'footer' => 'Footer',
        ];
        return view('admin.welcome-elements.edit', compact('element', 'elementTypes'));
    }

    public function update(Request $request, $id)
    {
        $element = WelcomeElement::findOrFail($id);

        $request->validate([
            'element_type' => 'required|string',
            'element_key' => 'required|string',
            'content' => 'required|string',
            'sort_order' => 'required|integer',
            'is_active' => 'boolean',
        ]);

        $element->update($request->all());

        AdminLog::create([
            'user_id' => Auth::id(),
            'action' => 'update_welcome_element',
            'details' => 'Updated welcome element: ' . $request->element_type . '.' . $request->element_key,
        ]);

        return redirect()->route('admin.welcome-elements.index')->with('success', 'Element berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $element = WelcomeElement::findOrFail($id);

        $element->delete();

        AdminLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete_welcome_element',
            'details' => 'Deleted welcome element: ' . $element->element_type . '.' . $element->element_key,
        ]);

        return redirect()->route('admin.welcome-elements.index')->with('success', 'Element berhasil dihapus.');
    }

    // Berita Management
    public function beritaIndex()
    {
        $berita = Berita::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.berita.index', compact('berita'));
    }

    public function beritaCreate()
    {
        return view('admin.berita.create');
    }

    public function beritaStore(StoreBeritaRequest $request)
    {
        $data = $request->validated();

        // Prioritas: jika ada file upload, gunakan file tersebut
        if ($request->hasFile('gambar_file')) {
            $file = $request->file('gambar_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/berita'), $filename);
            $data['gambar'] = 'images/berita/' . $filename;
        }
        // Jika tidak ada file upload, gunakan URL yang dimasukkan
        elseif ($request->filled('gambar')) {
            // Jika admin memasukkan URL gambar, coba download dan simpan secara lokal
            $remoteUrl = $request->gambar;
            $downloaded = $this->downloadRemoteImage($remoteUrl);
            if ($downloaded) {
                $data['gambar'] = $downloaded; // path lokal
            } else {
                // fallback: simpan URL asli jika download gagal
                $data['gambar'] = $remoteUrl;
            }
        }

        Berita::create($data);

        AdminLog::create([
            'user_id' => Auth::id(),
            'action' => 'create_berita',
            'details' => 'Created berita: ' . $request->judul,
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function beritaEdit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function beritaUpdate(UpdateBeritaRequest $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $data = $request->validated();

        // Prioritas: jika ada file upload, gunakan file tersebut
        if ($request->hasFile('gambar_file')) {
            $file = $request->file('gambar_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/berita'), $filename);
            $data['gambar'] = 'images/berita/' . $filename;
        }
        // Jika tidak ada file upload, gunakan URL yang dimasukkan
        elseif ($request->filled('gambar')) {
            $remoteUrl = $request->gambar;
            $downloaded = $this->downloadRemoteImage($remoteUrl);
            if ($downloaded) {
                $data['gambar'] = $downloaded;
            } else {
                $data['gambar'] = $remoteUrl;
            }
        }

        $berita->update($data);

        AdminLog::create([
            'user_id' => Auth::id(),
            'action' => 'update_berita',
            'details' => 'Updated berita: ' . $request->judul,
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function beritaDestroy($id)
    {
        $berita = Berita::findOrFail($id);

        $berita->delete();

        AdminLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete_berita',
            'details' => 'Deleted berita: ' . $berita->judul,
        ]);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }

    // Profil Desa Management
    public function indexProfilDesa()
    {
        $profilDesa = ProfilDesa::first();
        $logs = AdminLog::where('action', 'update_profil_desa')
                        ->with('user')
                        ->latest()
                        ->paginate(10);

        return view('admin.profil-desa.index', compact('profilDesa', 'logs'));
    }

    public function editProfilDesa()
    {
        $profilDesa = ProfilDesa::first();
        return view('admin.profil-desa.edit', compact('profilDesa'));
    }

    public function updateProfilDesa(Request $request)
    {
        $request->validate([
            'sejarah_desa' => 'required|string',
            'visi' => 'required|string',
            'misi' => 'required|string',
            'luas_wilayah' => 'required|string',
            'batas_utara' => 'required|string',
            'batas_selatan' => 'required|string',
            'batas_timur' => 'required|string',
            'batas_barat' => 'required|string',
            'jumlah_dusun' => 'required|integer',
            'jumlah_rt' => 'required|integer',
            'jumlah_rw' => 'required|integer',
            'peta_embed' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        $dataWilayah = [
            'luas_wilayah' => $request->luas_wilayah,
            'batas_utara' => $request->batas_utara,
            'batas_selatan' => $request->batas_selatan,
            'batas_timur' => $request->batas_timur,
            'batas_barat' => $request->batas_barat,
            'jumlah_dusun' => $request->jumlah_dusun,
            'jumlah_rt' => $request->jumlah_rt,
            'jumlah_rw' => $request->jumlah_rw,
        ];

        $profilDesa = ProfilDesa::first();
        if (!$profilDesa) {
            $profilDesa = new ProfilDesa();
        }

        $profilDesa->fill([
            'sejarah_desa' => $request->sejarah_desa,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'data_wilayah' => $dataWilayah,
            'peta_embed' => $request->peta_embed,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
        $profilDesa->save();

        AdminLog::create([
            'user_id' => Auth::id(),
            'action' => 'update_profil_desa',
            'details' => 'Updated profil desa',
        ]);

        return redirect()->route('admin.profil-desa.index')->with('status', 'Profil desa berhasil diperbarui.');
    }

    // Struktur Pemerintahan Management
    public function indexStruktur()
    {
        $struktur = StrukturPemerintahan::ordered()->paginate(15);
        return view('admin.struktur-pemerintahan.index', compact('struktur'));
    }

    public function createStruktur()
    {
        return view('admin.struktur-pemerintahan.create');
    }

    public function storeStruktur(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urutan' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/struktur'), $filename);
            $data['foto'] = 'images/struktur/' . $filename;
        }

        StrukturPemerintahan::create($data);

        AdminLog::create([
            'user_id' => Auth::id(),
            'action' => 'create_struktur_pemerintahan',
            'details' => 'Created struktur pemerintahan: ' . $request->nama,
        ]);

        return redirect()->route('admin.struktur-pemerintahan.index')->with('success', 'Struktur pemerintahan berhasil ditambahkan.');
    }

    public function editStruktur($id)
    {
        $struktur = StrukturPemerintahan::findOrFail($id);
        return view('admin.struktur-pemerintahan.edit', compact('struktur'));
    }

    public function updateStruktur(Request $request, $id)
    {
        $struktur = StrukturPemerintahan::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'urutan' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();

        // Handle foto upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/struktur'), $filename);
            $data['foto'] = 'images/struktur/' . $filename;
        }

        $struktur->update($data);

        AdminLog::create([
            'user_id' => Auth::id(),
            'action' => 'update_struktur_pemerintahan',
            'details' => 'Updated struktur pemerintahan: ' . $request->nama,
        ]);

        return redirect()->route('admin.struktur-pemerintahan.index')->with('success', 'Struktur pemerintahan berhasil diperbarui.');
    }

    public function destroyStruktur($id)
    {
        $struktur = StrukturPemerintahan::findOrFail($id);

        $struktur->delete();

        AdminLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete_struktur_pemerintahan',
            'details' => 'Deleted struktur pemerintahan: ' . $struktur->nama,
        ]);

        return redirect()->route('admin.struktur-pemerintahan.index')->with('success', 'Struktur pemerintahan berhasil dihapus.');
    }

    // Layanan Management
    public function layananIndex()
    {
        $layanan = Layanan::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.layanan.index', compact('layanan'));
    }

    public function layananCreate()
    {
        return view('admin.layanan.create');
    }

    public function layananStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|in:administrasi,perizinan',
            'deskripsi' => 'required|string',
            'prosedur' => 'required|array',
            'prosedur.*' => 'required|string',
            'syarat' => 'required|array',
            'syarat.*' => 'required|string',
            'waktu_proses' => 'required|string|max:255',
            'biaya' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/layanan'), $filename);
            $data['gambar'] = 'images/layanan/' . $filename;
        }

        Layanan::create($data);

        AdminLog::create([
            'user_id' => Auth::id(),
            'action' => 'create_layanan',
            'details' => 'Created layanan: ' . $request->nama,
        ]);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function layananEdit($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function layananUpdate(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|in:administrasi,perizinan',
            'deskripsi' => 'required|string',
            'prosedur' => 'required|array',
            'prosedur.*' => 'required|string',
            'syarat' => 'required|array',
            'syarat.*' => 'required|string',
            'waktu_proses' => 'required|string|max:255',
            'biaya' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/layanan'), $filename);
            $data['gambar'] = 'images/layanan/' . $filename;
        }

        $layanan->update($data);

        AdminLog::create([
            'user_id' => Auth::id(),
            'action' => 'update_layanan',
            'details' => 'Updated layanan: ' . $request->nama,
        ]);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function layananDestroy($id)
    {
        $layanan = Layanan::findOrFail($id);

        $layanan->delete();

        AdminLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete_layanan',
            'details' => 'Deleted layanan: ' . $layanan->nama,
        ]);

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus.');
    }

    // Potensi Management
    public function potensiIndex()
    {
        $potensi = Potensi::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.potensi.index', compact('potensi'));
    }

    public function potensiCreate()
    {
        return view('admin.potensi.create');
    }

    public function potensiStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'detail' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kontak' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/potensi'), $filename);
            $data['gambar'] = 'images/potensi/' . $filename;
        }

        Potensi::create($data);

        AdminLog::create([
            'user_id' => Auth::id(),
            'action' => 'create_potensi',
            'details' => 'Created potensi: ' . $request->nama,
        ]);

        return redirect()->route('admin.potensi.index')->with('success', 'Potensi berhasil ditambahkan.');
    }

    public function potensiEdit($id)
    {
        $potensi = Potensi::findOrFail($id);
        return view('admin.potensi.edit', compact('potensi'));
    }

    public function potensiUpdate(Request $request, $id)
    {
        $potensi = Potensi::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'detail' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kontak' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:255',
            'lokasi' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/potensi'), $filename);
            $data['gambar'] = 'images/potensi/' . $filename;
        }

        $potensi->update($data);

        AdminLog::create([
            'user_id' => Auth::id(),
            'action' => 'update_potensi',
            'details' => 'Updated potensi: ' . $request->nama,
        ]);

        return redirect()->route('admin.potensi.index')->with('success', 'Potensi berhasil diperbarui.');
    }

    public function potensiDestroy($id)
    {
        $potensi = Potensi::findOrFail($id);

        $potensi->delete();

        AdminLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete_potensi',
            'details' => 'Deleted potensi: ' . $potensi->nama,
        ]);

        return redirect()->route('admin.potensi.index')->with('success', 'Potensi berhasil dihapus.');
    }

    // Galeri Management
    public function galeriIndex()
    {
        $galeri = Galeri::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.galeri.index', compact('galeri'));
    }

    public function galeriCreate()
    {
        $kategoris = [
            'kegiatan' => 'Kegiatan Desa',
            'pembangunan' => 'Pembangunan Infrastruktur',
            'event' => 'Event dan Festival',
            'panorama' => 'Panorama Desa',
        ];
        return view('admin.galeri.create', compact('kategoris'));
    }

    public function galeriStore(StoreGaleriRequest $request)
    {
        $data = $request->validated();

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/galeri'), $filename);
            $data['gambar'] = 'images/galeri/' . $filename;
        }

        Galeri::create($data);

        AdminLog::create([
            'user_id' => Auth::id(),
            'action' => 'create_galeri',
            'details' => 'Created galeri: ' . $request->judul,
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function galeriEdit($id)
    {
        $galeri = Galeri::findOrFail($id);
        $kategoris = [
            'kegiatan' => 'Kegiatan Desa',
            'pembangunan' => 'Pembangunan Infrastruktur',
            'event' => 'Event dan Festival',
            'panorama' => 'Panorama Desa',
        ];
        return view('admin.galeri.edit', compact('galeri', 'kategoris'));
    }

    public function galeriUpdate(UpdateGaleriRequest $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $data = $request->validated();

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/galeri'), $filename);
            $data['gambar'] = 'images/galeri/' . $filename;
        }

        $galeri->update($data);

        AdminLog::create([
            'user_id' => Auth::id(),
            'action' => 'update_galeri',
            'details' => 'Updated galeri: ' . $request->judul,
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function galeriDestroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        $galeri->delete();

        AdminLog::create([
            'user_id' => Auth::id(),
            'action' => 'delete_galeri',
            'details' => 'Deleted galeri: ' . $galeri->judul,
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }

    /**
     * Attempt to download a remote image URL and save it to public/images/berita.
     * Returns the local relative path on success (e.g. 'images/berita/xxx.jpg') or null on failure.
     */
    private function downloadRemoteImage(string $url): ?string
    {
        // Basic validation
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return null;
        }

        // Handle some known host patterns that don't return direct image links (e.g., Google Drive, Google Images)
        $downloadUrl = $url;
        $parsed = parse_url($url);

        // Google Images page links often wrap the real image URL in the 'imgurl' query param
        if (isset($parsed['host']) && (strpos($parsed['host'], 'google.') !== false)) {
            $path = $parsed['path'] ?? '';
            if (strpos($path, '/imgres') !== false && isset($parsed['query'])) {
                parse_str($parsed['query'], $q);
                if (!empty($q['imgurl'])) {
                    $downloadUrl = urldecode($q['imgurl']);
                }
            }
            // fallback: sometimes the URL isn't parsed correctly (spaces etc). Try regex on full URL string
            if ($downloadUrl === $url) {
                if (preg_match('/[?&]imgurl=([^&]+)/i', $url, $m)) {
                    $downloadUrl = urldecode($m[1]);
                }
            }
        }

        if (isset($parsed['host']) && strpos($parsed['host'], 'drive.google.com') !== false) {
            // patterns: /file/d/FILE_ID or ?id=FILE_ID
            if (preg_match('#/file/d/([a-zA-Z0-9_-]+)#', $url, $m)) {
                $fileId = $m[1];
                $downloadUrl = 'https://drive.google.com/uc?export=download&id=' . $fileId;
            } elseif (isset($parsed['query'])) {
                parse_str($parsed['query'], $q);
                if (!empty($q['id'])) {
                    $downloadUrl = 'https://drive.google.com/uc?export=download&id=' . $q['id'];
                }
            }
        }

        // Try to fetch headers first
        Log::info('downloadRemoteImage: start', ['original_url' => $url, 'download_url' => $downloadUrl]);
        $headers = @get_headers($downloadUrl, 1);
        if (!$headers || !isset($headers[0]) || stripos($headers[0], '200') === false) {
            Log::warning('downloadRemoteImage: headers check failed', ['download_url' => $downloadUrl, 'headers' => $headers ?? null]);
            return null;
        }

        // Determine content type
        $contentType = null;
        if (is_array($headers) && isset($headers['Content-Type'])) {
            $contentType = is_array($headers['Content-Type']) ? $headers['Content-Type'][0] : $headers['Content-Type'];
        }
        if (!$contentType) {
            return null;
        }

        if (stripos($contentType, 'image/') !== 0) {
            return null; // not an image
        }

        // Map mime to extension
        $map = [
            'image/jpeg' => 'jpg',
            'image/jpg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp',
        ];
        $ext = $map[strtolower($contentType)] ?? null;
        if (!$ext) {
            // try to parse subtype
            $parts = explode('/', $contentType);
            $ext = end($parts) ?: 'jpg';
        }

        // Download the file
        try {
            $content = file_get_contents($downloadUrl);
            if ($content === false) {
                return null;
            }

            // Ensure directory exists
            $dir = public_path('images/berita');
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }

            // Generate filename
            $filename = time() . '_' . uniqid() . '.' . $ext;
            $filepath = $dir . '/' . $filename;

            // Save file
            if (file_put_contents($filepath, $content) === false) {
                return null;
            }

            return 'images/berita/' . $filename;
        } catch (\Exception $e) {
            Log::error('downloadRemoteImage: download failed', ['url' => $downloadUrl, 'error' => $e->getMessage()]);
            return null;
        }
    }
}
