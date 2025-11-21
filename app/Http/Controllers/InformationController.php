<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Information;
use Illuminate\Support\Facades\Validator;

class InformationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::check() && Auth::user()->role !== 'admin') {
                // Check for temporary admin access
                if (session('temp_admin_access') && session('temp_access_expires') > now()) {
                    return $next($request);
                }
                
                // Check if user has requested access approval
                if ($request->has('request_access')) {
                    return $this->showAccessRequest($request);
                }
                
                // Show access request form instead of 403 error
                return response()->view('admin.access-request', [
                    'user' => Auth::user(),
                    'requested_url' => $request->fullUrl()
                ], 403);
            }
            return $next($request);
        });
    }

    private function showAccessRequest($request)
    {
        // Handle access approval/rejection
        if ($request->input('action') === 'approve') {
            // Temporarily grant access by setting session
            session(['temp_admin_access' => true, 'temp_access_expires' => now()->addHours(1)]);
            return redirect($request->input('original_url', '/admin/information'));
        }
        
        if ($request->input('action') === 'reject') {
            return redirect('/user/dashboard')->with('error', 'Akses ditolak. Anda tidak memiliki izin untuk mengakses halaman tersebut.');
        }
        
        return response()->view('admin.access-request', [
            'user' => Auth::user(),
            'requested_url' => $request->input('original_url', $request->fullUrl())
        ], 403);
    }

    public function index()
    {
        $informations = Information::with('creator')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.information.index', compact('informations'));
    }

    public function create()
    {
        return view('admin.information.create');
    }

    public function store(Request $request)
    {
        // Debug logging
        \Log::info('Store method called', [
            'request_data' => $request->all(),
            'user_id' => Auth::id(),
            'user_role' => Auth::user()->role ?? 'unknown'
        ]);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:5000',
            'type' => 'required|in:announcement,news,event,general',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
            'expires_at' => 'nullable|date'
        ], [
            'title.required' => 'Judul informasi wajib diisi',
            'title.max' => 'Judul maksimal 255 karakter',
            'content.required' => 'Konten informasi wajib diisi',
            'content.max' => 'Konten maksimal 5000 karakter',
            'type.required' => 'Tipe informasi wajib dipilih',
            'type.in' => 'Tipe informasi tidak valid'
        ]);

        if ($validator->fails()) {
            \Log::error('Validation failed', ['errors' => $validator->errors()]);
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = [
                'title' => $request->title,
                'content' => $request->content,
                'type' => $request->type,
                'priority' => 'medium',
                'is_published' => $request->boolean('is_published', true),
                'published_at' => $request->published_at ?: now(),
                'expires_at' => $request->expires_at,
                'created_by' => Auth::id()
            ];

            \Log::info('Creating information with data', $data);

            $information = Information::create($data);

            \Log::info('Information created successfully', ['id' => $information->id]);

            return redirect()->route('admin.information.index')
                ->with('success', 'Informasi berhasil ditambahkan!');

        } catch (\Exception $e) {
            \Log::error('Error creating information', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan informasi: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function edit($id)
    {
        $information = Information::findOrFail($id);
        return view('admin.information.edit', compact('information'));
    }

    public function update(Request $request, $id)
    {
        $information = Information::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:5000',
            'type' => 'required|in:announcement,news,event,general',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after:published_at'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $information->update([
                'title' => $request->title,
                'content' => $request->content,
                'type' => $request->type,
                'priority' => 'medium',
                'is_published' => $request->boolean('is_published'),
                'published_at' => $request->published_at,
                'expires_at' => $request->expires_at
            ]);

            return redirect()->route('admin.information.index')
                ->with('success', 'Informasi berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat memperbarui informasi.'])
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $information = Information::findOrFail($id);
            $information->delete();

            return redirect()->route('admin.information.index')
                ->with('success', 'Informasi berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menghapus informasi.']);
        }
    }

    public function togglePublish($id)
    {
        try {
            $information = Information::findOrFail($id);
            $information->update([
                'is_published' => !$information->is_published,
                'published_at' => !$information->is_published ? now() : null
            ]);

            $status = $information->is_published ? 'dipublikasikan' : 'diunpublish';
            return redirect()->back()
                ->with('success', "Informasi berhasil {$status}!");

        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat mengubah status publikasi.']);
        }
    }
}
