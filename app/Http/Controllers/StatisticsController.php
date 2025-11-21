<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\User;
use App\Models\Information;
use App\Models\Like;
use App\Models\Comment;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class StatisticsController extends Controller
{
    public function index()
    {
        try {
            // Get basic statistics
            $stats = [
                'total_photos' => Photo::count(),
                'total_users' => User::count(),
                'total_information' => Information::count(),
                'total_likes' => Like::count(),
                'total_comments' => Comment::count(),
                'total_categories' => Photo::select('category')->distinct()->count(),
            ];

            // Get photos by category
            $photosByCategory = Photo::select('category', \DB::raw('count(*) as count'))
                ->groupBy('category')
                ->orderBy('count', 'desc')
                ->get();

            // Get monthly uploads (last 6 months)
            $monthlyUploads = Photo::select(
                    \DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                    \DB::raw('count(*) as count')
                )
                ->where('created_at', '>=', Carbon::now()->subMonths(6))
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            // Get user growth (last 6 months)
            $userGrowth = User::select(
                    \DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                    \DB::raw('count(*) as count')
                )
                ->where('created_at', '>=', Carbon::now()->subMonths(6))
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            // Get most liked photos
            $mostLikedPhotos = Photo::withCount('likes')
                ->orderBy('likes_count', 'desc')
                ->limit(5)
                ->get();

            // Get most commented photos
            $mostCommentedPhotos = Photo::withCount('comments')
                ->orderBy('comments_count', 'desc')
                ->limit(5)
                ->get();

            // Get recent photos
            $recentPhotos = Photo::with('user')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            // Get recent users
            $recentUsers = User::orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            // Get recent comments
            $recentComments = Comment::with(['photo', 'user'])
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            return view('admin.statistics.index', compact(
                'stats',
                'photosByCategory',
                'monthlyUploads',
                'userGrowth',
                'mostLikedPhotos',
                'mostCommentedPhotos',
                'recentPhotos',
                'recentUsers',
                'recentComments'
            ));
            
        } catch (\Exception $e) {
            \Log::error('StatisticsController error: ' . $e->getMessage());
            
            // Return basic stats if there's an error
            $basicStats = [
                'total_photos' => Photo::count(),
                'total_users' => User::count(),
                'total_information' => Information::count(),
                'total_likes' => Like::count(),
                'total_comments' => Comment::count(),
                'total_categories' => Photo::select('category')->distinct()->count(),
            ];
            
            return view('admin.statistics.index', [
                'stats' => $basicStats,
                'photosByCategory' => collect([]),
                'monthlyUploads' => collect([]),
                'userGrowth' => collect([]),
                'mostLikedPhotos' => collect([]),
                'mostCommentedPhotos' => collect([]),
                'recentPhotos' => collect([]),
                'recentUsers' => collect([]),
                'recentComments' => collect([])
            ]);
        }
    }

    public function generatePdf(Request $request)
    {
        // Get basic statistics
        $stats = [
            'total_photos' => Photo::count(),
            'total_users' => User::count(),
            'total_information' => Information::count(),
            'total_likes' => Like::count(),
            'total_comments' => Comment::count(),
            'total_categories' => Photo::select('category')->distinct()->count(),
        ];

        $photosByCategory = Photo::select('category', \DB::raw('count(*) as count'))
            ->groupBy('category')
            ->orderBy('count', 'desc')
            ->get();

        $monthlyUploads = Photo::select(
                \DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                \DB::raw('count(*) as count')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $userGrowth = User::select(
                \DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                \DB::raw('count(*) as count')
            )
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $mostLikedPhotos = Photo::withCount('likes')
            ->orderBy('likes_count', 'desc')
            ->limit(10)
            ->get();

        $mostCommentedPhotos = Photo::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->limit(10)
            ->get();

        $recentPhotos = Photo::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $recentUsers = User::orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $recentComments = Comment::with(['photo', 'user'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $pdf = PDF::loadView('admin.statistics.pdf', compact(
            'stats',
            'photosByCategory',
            'monthlyUploads',
            'userGrowth',
            'mostLikedPhotos',
            'mostCommentedPhotos',
            'recentPhotos',
            'recentUsers',
            'recentComments'
        ));

        return $pdf->download('laporan-statistik-galeri-' . date('Y-m-d') . '.pdf');
    }
}
