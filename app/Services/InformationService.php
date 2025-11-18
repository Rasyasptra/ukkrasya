<?php

namespace App\Services;

use App\Models\Information;
use Carbon\Carbon;

class InformationService
{
    /**
     * Create a new information record
     */
    public function createInformation(array $data): Information
    {
        return Information::create($data);
    }

    /**
     * Update an existing information record
     */
    public function updateInformation(Information $information, array $data): Information
    {
        $information->update($data);
        return $information->fresh();
    }

    /**
     * Delete an information record
     */
    public function deleteInformation(Information $information): bool
    {
        return $information->delete();
    }

    /**
     * Publish an information
     */
    public function publishInformation(Information $information): Information
    {
        $information->update([
            'is_published' => true,
            'published_at' => now(),
        ]);

        return $information->fresh();
    }

    /**
     * Unpublish an information
     */
    public function unpublishInformation(Information $information): Information
    {
        $information->update([
            'is_published' => false,
            'published_at' => null,
        ]);

        return $information->fresh();
    }

    /**
     * Get all published information
     */
    public function getPublishedInformation()
    {
        return Information::where('is_published', true)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->orderBy('priority', 'desc')
            ->orderBy('published_at', 'desc')
            ->paginate(10);
    }

    /**
     * Get information by type
     */
    public function getInformationByType(string $type)
    {
        return Information::where('type', $type)
            ->where('is_published', true)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->orderBy('priority', 'desc')
            ->orderBy('published_at', 'desc')
            ->paginate(10);
    }

    /**
     * Search information by title or content
     */
    public function searchInformation(string $query)
    {
        return Information::where('is_published', true)
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%");
            })
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->orderBy('priority', 'desc')
            ->orderBy('published_at', 'desc')
            ->paginate(10);
    }

    /**
     * Get all information (for admin)
     */
    public function getAllInformation()
    {
        return Information::with('creator')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
    }

    /**
     * Get recent information
     */
    public function getRecentInformation(int $limit = 5)
    {
        return Information::where('is_published', true)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->orderBy('published_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Get information by priority
     */
    public function getInformationByPriority(string $priority)
    {
        return Information::where('priority', $priority)
            ->where('is_published', true)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->orderBy('published_at', 'desc')
            ->paginate(10);
    }

    /**
     * Get expired information
     */
    public function getExpiredInformation()
    {
        return Information::where('is_published', true)
            ->where('expires_at', '<=', now())
            ->orderBy('expires_at', 'desc')
            ->get();
    }

    /**
     * Get information statistics
     */
    public function getInformationStatistics(): array
    {
        return [
            'total_information' => Information::count(),
            'published_information' => Information::where('is_published', true)->count(),
            'draft_information' => Information::where('is_published', false)->count(),
            'expired_information' => $this->getExpiredInformation()->count(),
            'information_by_type' => Information::selectRaw('type, COUNT(*) as count')
                ->groupBy('type')
                ->pluck('count', 'type')
                ->toArray(),
            'information_by_priority' => Information::selectRaw('priority, COUNT(*) as count')
                ->groupBy('priority')
                ->pluck('count', 'priority')
                ->toArray(),
        ];
    }

    /**
     * Auto-unpublish expired information
     */
    public function autoUnpublishExpired(): int
    {
        $expiredCount = Information::where('is_published', true)
            ->where('expires_at', '<=', now())
            ->update(['is_published' => false]);

        return $expiredCount;
    }

    /**
     * Get information by creator
     */
    public function getInformationByCreator(int $userId)
    {
        return Information::where('created_by', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
    }

    /**
     * Validate information data
     */
    public function validateInformationData(array $data): array
    {
        $validated = [];

        // Required fields
        $validated['title'] = trim($data['title'] ?? '');
        $validated['content'] = trim($data['content'] ?? '');
        $validated['type'] = $data['type'] ?? 'general';
        $validated['priority'] = $data['priority'] ?? 'medium';
        $validated['created_by'] = $data['created_by'] ?? auth()->id();

        // Optional fields
        $validated['is_published'] = $data['is_published'] ?? false;
        $validated['published_at'] = $data['published_at'] ?? null;
        $validated['expires_at'] = $data['expires_at'] ?? null;

        // Validate type
        $validTypes = ['announcement', 'news', 'event', 'general'];
        if (!in_array($validated['type'], $validTypes)) {
            $validated['type'] = 'general';
        }

        // Validate priority
        $validPriorities = ['urgent', 'high', 'medium', 'low'];
        if (!in_array($validated['priority'], $validPriorities)) {
            $validated['priority'] = 'medium';
        }

        // Parse dates
        if ($validated['published_at'] && is_string($validated['published_at'])) {
            $validated['published_at'] = Carbon::parse($validated['published_at']);
        }

        if ($validated['expires_at'] && is_string($validated['expires_at'])) {
            $validated['expires_at'] = Carbon::parse($validated['expires_at']);
        }

        return $validated;
    }
}
