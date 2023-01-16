<?php

namespace AscentCreative\Store\Policies;

use AscentCreative\Store\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function download(User $user, Product $product) {

        // product must be a download, and must be a) Free or b) owned by the user
        if($product->is_download)
            if($user->owns($product) || $product->price == 0)
                return true;

        return false;

    }


    // /**
    //  * Determine whether the user can view any models.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @return \Illuminate\Auth\Access\Response|bool
    //  */
    // public function viewAny(User $user)
    // {
    //     //
    //     return true;
    // }

    // /**
    //  * Determine whether the user can view the model.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @return \Illuminate\Auth\Access\Response|bool
    //  */
    // public function view(User $user, Product $product)
    // {

    //     // return $product->ownership()->where('contact_id', getPortalActiveContactId())->exists();
    //     return true;
    // }

    // /**
    //  * Determine whether the user can create models.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @return \Illuminate\Auth\Access\Response|bool
    //  */
    // public function create(User $user)
    // {
    //     //
    //     return true;
    // }

    //  /**
    //  * Determine whether the user can create models without sandboxing.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @return \Illuminate\Auth\Access\Response|bool
    //  */
    // public function createWithoutApproval(User $user)
    // {
      
    //     if (session('require_content_approval') == 1) {
    //         return false;
    //     } else {
    //         return true;
    //     }
        
    // }

    // /**
    //  * Determine whether the user can update the model.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @param  \App\Models\Note  $note
    //  * @return \Illuminate\Auth\Access\Response|bool
    //  */
    // public function update(User $user, Product $product)
    // {
    //     // note ID might be blank if we're dealing with a temporary / unsaved note.
    //     return false;
    // }

    // /**
    //  * Determine whether the user can delete the model.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @param  \App\Models\Note  $note
    //  * @return \Illuminate\Auth\Access\Response|bool
    //  */
    // public function delete(User $user, Product $product)
    // {
    //     //
    //     return false;

    // }

    // /**
    //  * Determine whether the user can restore the model.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @param  \App\Models\Note  $note
    //  * @return \Illuminate\Auth\Access\Response|bool
    //  */
    // public function restore(User $user, Note $note)
    // {
    //     //
    //     return true;
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  *
    //  * @param  \App\Models\User  $user
    //  * @param  \App\Models\Note  $note
    //  * @return \Illuminate\Auth\Access\Response|bool
    //  */
    // public function forceDelete(User $user, Product $product)
    // {
    //     //
    //     return false;
    // }
}
