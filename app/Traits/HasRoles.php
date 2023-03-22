<?php

namespace App\Traits;

trait HasRoles{

        /**
     * roles authenticated methods
     */
    public function syncRoles($roles) : void
    {
        if(is_string($roles))
            $roles = explode('|', $roles);

        $this->roles = implode('|', $roles);
        $this->save();
    }

    public function getRoles() : array
    {
        return explode('|', $this->roles);
    }

    public function hasRole(mixed $role) : Bool
    {
        return $this->hasAnyRole($role);
    }

    public function hasAnyRole(mixed $roles) : Bool
    {
        if(is_string($roles))
            $roles = explode('|', $roles);

        return count(array_intersect($roles, $this->getRoles())) > 0;
    }



    /**
     * scopes
     */
    public function scopeRoles($query, $roles){
        if(is_string($roles))
            $roles = explode('|', $roles);

        collect($roles)->each(function($role, $index)use($query){
            if($index ==0){
                $query->where('roles', 'LIKE', "%{$role}%");
            }else{
                $query->orWhere('roles', 'LIKE', "%{$role}%");
            }
        });
    }


}