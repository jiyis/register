<?php

namespace App\Models;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    protected $fillable = ['fid', 'icon', 'name', 'display_name', 'description', 'is_menu', 'sort'];

    protected $appends = ['icon_html', 'sub_permission'];

    public function getIconHtmlAttribute()
    {
        return $this->attributes['icon'] ? '<i class="fa fa-' . $this->attributes['icon'] . '"></i>' : '';
    }

    public function getNameAttribute($value)
    {
        if(starts_with($value, '#')) {
            return head(explode('-', $value));
        }
        return $value;
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ($value == '#') ? '#-' . time() : $value;
    }

    public function getSubPermissionAttribute()
    {
        return ($this->attributes['fid'] == 0) ? $this->where('fid',$this->attributes['id'])->orderBy('sort', 'asc')->get() : null;
    }
}
