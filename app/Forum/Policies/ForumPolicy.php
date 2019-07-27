<?php namespace App\Forum\Policies;

class ForumPolicy
{
    /**
     * Permission: Create categories.
     *
     * @param  object  $user
     * @return bool
     */
    public function createCategories($user)
    {
        if (in_array($user->email, config('admin_emails'))) {
            return true;
        } else return false;
    }

    /**
     * Permission: Manage category.
     *
     * @param  object  $user
     * @return bool
     */
    public function manageCategories($user)
    {
        return $this->moveCategories($user) ||
            $this->renameCategories($user);
    }

    /**
     * Permission: Move categories.
     *
     * @param  object  $user
     * @return bool
     */
    public function moveCategories($user)
    {
        return false;
    }

    /**
     * Permission: Rename categories.
     *
     * @param  object  $user
     * @return bool
     */
    public function renameCategories($user)
    {
        return false;
    }

    /**
     * Permission: Mark new/updated threads as read.
     *
     * @param  object  $user
     * @return bool
     */
    public function markNewThreadsAsRead($user)
    {
        return false;
    }

    /**
     * Permission: View trashed threads.
     *
     * @param  object  $user
     * @return bool
     */
    public function viewTrashedThreads($user)
    {
        return false;
    }

    /**
     * Permission: View trashed posts.
     *
     * @param  object  $user
     * @return bool
     */
    public function viewTrashedPosts($user)
    {
        return false;
    }
}
