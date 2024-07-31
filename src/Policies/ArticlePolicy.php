<?php

namespace AdminKit\Articles\Policies;

use AdminKit\Articles\Models\Article;
use App\Models\AdminKitUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the adminKitUser can view any models.
     */
    public function viewAny(AdminKitUser $adminKitUser): bool
    {
        return $adminKitUser->can('view_any_article');
    }

    /**
     * Determine whether the adminKitUser can view the model.
     */
    public function view(AdminKitUser $adminKitUser, Article $article): bool
    {
        return $adminKitUser->can('view_article');
    }

    /**
     * Determine whether the adminKitUser can create models.
     */
    public function create(AdminKitUser $adminKitUser): bool
    {
        return $adminKitUser->can('create_article');
    }

    /**
     * Determine whether the adminKitUser can update the model.
     */
    public function update(AdminKitUser $adminKitUser, Article $article): bool
    {
        return $adminKitUser->can('update_article');
    }

    /**
     * Determine whether the adminKitUser can delete the model.
     */
    public function delete(AdminKitUser $adminKitUser, Article $article): bool
    {
        return $adminKitUser->can('delete_article');
    }

    /**
     * Determine whether the adminKitUser can bulk delete.
     */
    public function deleteAny(AdminKitUser $adminKitUser): bool
    {
        return $adminKitUser->can('delete_any_article');
    }

    /**
     * Determine whether the adminKitUser can permanently delete.
     */
    public function forceDelete(AdminKitUser $adminKitUser, Article $article): bool
    {
        return $adminKitUser->can('force_delete_article');
    }

    /**
     * Determine whether the adminKitUser can permanently bulk delete.
     */
    public function forceDeleteAny(AdminKitUser $adminKitUser): bool
    {
        return $adminKitUser->can('force_delete_any_article');
    }

    /**
     * Determine whether the adminKitUser can restore.
     */
    public function restore(AdminKitUser $adminKitUser, Article $article): bool
    {
        return $adminKitUser->can('restore_article');
    }

    /**
     * Determine whether the adminKitUser can bulk restore.
     */
    public function restoreAny(AdminKitUser $adminKitUser): bool
    {
        return $adminKitUser->can('restore_any_article');
    }

    /**
     * Determine whether the adminKitUser can replicate.
     */
    public function replicate(AdminKitUser $adminKitUser, Article $article): bool
    {
        return $adminKitUser->can('replicate_article');
    }

    /**
     * Determine whether the adminKitUser can reorder.
     */
    public function reorder(AdminKitUser $adminKitUser): bool
    {
        return $adminKitUser->can('reorder_article');
    }
}
