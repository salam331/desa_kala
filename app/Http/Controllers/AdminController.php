<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBeritaRequest;
use App\Http\Requests\UpdateBeritaRequest;
use App\Models\AdminLog;
use App\Models\Berita;
use App\Models\Pengaduan;
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
            'total_layanan' => 0, // Placeholder
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
            // First try simple file_get_contents
            $imageData = @file_get_contents($downloadUrl);
            if ($imageData === false) {
                Log::info('downloadRemoteImage: initial file_get_contents failed, trying with stream context', ['download_url' => $downloadUrl]);
                // Fallback: try with a browser-like User-Agent and timeout
                $context = stream_context_create([
                    'http' => [
                        'method' => 'GET',
                        'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)\r\n",
                        'timeout' => 15,
                        'follow_location' => 1,
                    ],
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ]);
                $imageData = @file_get_contents($downloadUrl, false, $context);
                if ($imageData === false) {
                    Log::error('downloadRemoteImage: failed to download image', ['download_url' => $downloadUrl]);
                    return null;
                }
            }

            $dir = public_path('images/berita');
            if (!is_dir($dir)) {
                if (!@mkdir($dir, 0755, true) && !is_dir($dir)) {
                    Log::error('downloadRemoteImage: failed to create directory', ['dir' => $dir]);
                    return null;
                }
            }

            $filename = time() . '_' . bin2hex(random_bytes(6)) . '.' . $ext;
            $path = $dir . DIRECTORY_SEPARATOR . $filename;
            $written = @file_put_contents($path, $imageData);
            if ($written === false) {
                Log::error('downloadRemoteImage: failed to write file', ['path' => $path]);
                return null;
            }

            Log::info('downloadRemoteImage: saved', ['path' => $path, 'relative' => 'images/berita/' . $filename]);

            // return relative path to public
            return 'images/berita/' . $filename;
        } catch (\Throwable $e) {
            return null;
        }
    }
}
