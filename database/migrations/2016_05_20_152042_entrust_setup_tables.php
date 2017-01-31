<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use App\Role;
use App\User;
use App\Permission;

class EntrustSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for associating roles to users (Many-to-Many)
        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'role_id']);
        });

        // Create table for storing permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });

        //Using Query builder
        // DB::table('users')->insert(
        //     array(
        //         'name' => 'Kavi Lakshmi',
        //         'email' => 'admin@example.com',
        //         'password' => bcrypt('password')
        //     )
        // );        

        //Add a couple of users in the system
        //Eloquent way
        $users = [
            ['name' => 'The Administrator', 'email' => 'admin@example.com', 'password' => bcrypt('password') ],
            ['name' => 'The Librarian', 'email' => 'librarian@example.com', 'password' => bcrypt('password') ]
        ];

        User::insert($users);

        //Add some roles in the system
        $admin = new Role();
        $admin->name         = 'admin';
        $admin->display_name = 'Administrator'; // optional
        $admin->description  = 'Omnipotent User in the System!'; // optional
        $admin->save();

        $librarian = new Role();
        $librarian->name         = 'librarian';
        $librarian->display_name = 'Librarian'; // optional
        $librarian->description  = 'One level below the admin role in the System!'; // optional
        $librarian->save();

        // $asst = new Role();
        // $asst->name         = 'Assistant';
        // $asst->display_name = 'Assistant Librarian'; // optional
        // $asst->description  = 'One level below the librarian role in the System!'; // optional
        // $asst->save();

        //Set what these roles can do in the system

        $manageAdmins = new Permission();
        $manageAdmins->name         = 'adminuser';
        $manageAdmins->display_name = 'Manage Admin Users!'; // optional
        $manageAdmins->description  = 'Manage(Create/Read/Update/Delete) Admin Users in the System!'; 
        $manageAdmins->save();

        $manageAuthors = new Permission();
        $manageAuthors->name         = 'author';
        $manageAuthors->display_name = 'Manage Authors!'; // optional
        $manageAuthors->description  = 'Manage(Create/Read/Update/Delete) Authors in the System!'; 
        $manageAuthors->save();

        $manageBooks = new Permission();
        $manageBooks->name         = 'book';
        $manageBooks->display_name = 'Manage Books!'; // optional
        $manageBooks->description  = 'Manage(Create/Read/Update/Delete) Books in the System!'; // optional
        $manageBooks->save();


        $manageCategories = new Permission();
        $manageCategories->name         = 'category';
        $manageCategories->display_name = 'Manage Categories!'; // optional
        $manageCategories->description  = 'Manage(Create/Read/Update/Delete) Categroies in the System!'; // optional
        $manageCategories->save();

        $manageIssues = new Permission();
        $manageIssues->name         = 'issue';
        $manageIssues->display_name = 'Manage Book Issues!'; // optional
        $manageIssues->description  = 'Manage(Create/Read/Update/Delete) Book Issues in the System!'; // optional
        $manageIssues->save();

        $managePublishers = new Permission();
        $managePublishers->name         = 'publisher';
        $managePublishers->display_name = 'Manage Publishers!'; // optional
        $managePublishers->description  = 'Manage(Create/Read/Update/Delete) Publishers in the System!'; // optional
        $managePublishers->save();


        $manageRequests = new Permission();
        $manageRequests->name         = 'request';
        $manageRequests->display_name = 'Manage Book Requests!'; // optional
        $manageRequests->description  = 'Manage(Create/Read/Update/Delete) Book Requests in the System!'; // optional
        $manageRequests->save();

        $manageRoles = new Permission();
        $manageRoles->name         = 'role';
        $manageRoles->display_name = 'Manage Roles!'; // optional
        $manageRoles->description  = 'Manage(Create/Read/Update/Delete) Roles in the System!'; // optional
        $manageRoles->save();

        $admin->attachPermission($manageAdmins);        
        $admin->attachPermission($manageAuthors);        
        $admin->attachPermission($manageBooks);        
        $admin->attachPermission($manageCategories);        
        $admin->attachPermission($managePublishers);        
        $admin->attachPermission($manageIssues);        
        $admin->attachPermission($manageRequests);        
        $admin->attachPermission($manageRoles);        

        $librarian->attachPermission($manageBooks);        
        $librarian->attachPermission($manageAuthors);        
        $librarian->attachPermission($manageCategories);        

        // $asst->attachPermission($manageCategories);        

        //Members of the system (i.e., those that use the fontend to request books)
        $member = new Role();
        $member->name         = 'member';
        $member->display_name = 'Member'; // optional
        $member->description  = 'Members of the system!'; // optional
        $member->save();

        $user = User::where('name', '=', 'The Administrator')->first();
        $user->attachRole($admin); 

        $user = User::where('name', '=', 'The Librarian')->first();
        $user->attachRole($librarian); 


    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('permission_role');
        Schema::drop('permissions');
        Schema::drop('role_user');
        Schema::drop('roles');
    }
}
