https://spatie.be/docs/laravel-permission/v8/installation-laravel

 $this->authorize("view-dashboard");
 @can("view-dashboard", $data)
 @endcan


Task	                           Function
Assign role	                       $user->assignRole('Teacher')
Assign multiple roles	           $user->assignRole([...])
Replace roles	                   $user->syncRoles([...])
Remove role	                       $user->removeRole('Teacher')
Remove all roles	               $user->syncRoles([])
Get roles	                       $user->roles
Get role names	                   $user->getRoleNames()
Give permission	                   $user->givePermissionTo('view-students')
Give multiple permissions	       $user->givePermissionTo([...])
Replace permissions	               $user->syncPermissions([...])
Remove permission	               $user->revokePermissionTo('view-students')
Remove all direct permissions	   $user->syncPermissions([])
Get direct permissions	           $user->permissions
Get all permissions	               $user->getAllPermissions()
Check permission	               $user->hasPermissionTo('view-students')
Check any permission	           $user->hasAnyPermission([...])
Check all permissions	           $user->hasAllPermissions([...])
Check role	                       $user->hasRole('Teacher')
Check any role	                   $user->hasAnyRole([...])
Create role	                       Role::create([...])
Create permission	               Permission::create([...])
Get all roles	                   Role::all()
Get all permissions	               Permission::all()
Role permissions	               $role->permissions
Role permission names	           $role->getPermissionNames()
Give permission to role	           $role->givePermissionTo([...])
Sync role permissions	           $role->syncPermissions([...])
Remove role permission	           $role->revokePermissionTo(...)
Find role by name	               Role::findByName('Teacher')
Find permission by name	           Permission::findByName('view-students')




