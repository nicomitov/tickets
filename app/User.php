<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use Laravolt\Avatar\Avatar;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'notify',
        'department_id',
        'mobile_phone',
        'work_phone',
        'position',
        'mobile_phone',
        'work_phone',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // public function tickets()
    // {
    //     return $this->morphToMany('App\Ticket', 'ticketable');
    // }


    public function roles()
    {
        return $this->belongsToMany(Role::Class);
    }

    public function hasRole(string $role)
    {
        $roles = $this->roles->pluck('name');

        return $roles->contains('admin') || $roles->contains($role);
    }

    public function causedTickets()
    {
        return $this->morphToMany('App\Ticket', 'ticketable');
    }

    public function tickets() // author
    {
        return $this->belongsToMany(Ticket::class)->withPivot('action')->withTimestamps();
    }

    public function uniqueTickets() // author
    {
        $tickets = [];
        foreach ($this->tickets->unique()->sortByDesc('created_at') as $ticket) {
            if ($ticket->users->first()->id == $this->id) {
                array_push($tickets, $ticket);
            }
        }

        return $tickets;
    }

    public function createDefaultAvatar()
    {
        $avatarDestPath = 'storage/photos/' . $this->id . '/avatars/';
        $thumbDestPath = 'storage/photos/' . $this->id . '/avatars/thumbs/';

        // make dir & del avatar if exists
        if (! File::exists($avatarDestPath)) {
            File::makeDirectory($avatarDestPath, 0777, true);
        }
        // dd($avatarDestPath . 'default.png');
        if (File::exists($avatarDestPath . 'default.png')) {
            unlink($avatarDestPath . 'default.png');
        }
        if (! File::exists($thumbDestPath)) {
            File::makeDirectory($thumbDestPath, 0777, true);
        }
        if (File::exists($thumbDestPath . 'default.png')) {
            unlink($thumbDestPath . 'default.png');
        }

        // avatar thumb 200
        \Avatar::create($this->name)
            ->setDimension(config('lfm.thumb_img_width'))
            ->setFontSize(config('lfm.thumb_img_width') / 2)
            ->save($thumbDestPath . 'default.png');

        // avatar 800
        \Avatar::create($this->name)
            ->setDimension(800)
            ->setFontSize(400)
            ->save($avatarDestPath . 'default.png');

        return true;
    }

    public function getAvatarThumb()
    {
        if ($this->avatar == 'default.png') {
            return '/storage/photos/' . $this->id . '/avatars/thumbs/default.png';
        } else {
            $avatar = explode('/', $this->avatar);
            $directory = dirname($this->avatar);
            $avatar = $directory . '/thumbs/' . end($avatar);
            return $avatar;
        }

    }

    public function getAvatar()
    {
        if ($this->avatar == 'default.png') {
            return '/storage/photos/' . $this->id . '/avatars/default.png';
        } else {
            return $this->avatar;
        }
    }

    static function activeUsers()
    {
        return self::where('deleted_at', NULL)
                   ->where('is_active', 1);
    }

    static function inactiveUsers()
    {
        return self::where('deleted_at', NULL)
                   ->where('is_active', 0);
    }
}
