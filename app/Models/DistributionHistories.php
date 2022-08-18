<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributionHistories extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function asset(){
        return $this->belongsTo(Asset::class);
    }

    public function supervisor(){
        return $this->belongsTo(Employee::class, 'supervisor_id');
    }

    public function financeasset(){
        return $this->belongsTo(Employee::class, 'finance_and_assets_subsection_id');
    }

    public function itemmanager(){
        return $this->belongsTo(Employee::class, 'user_item_manager_id');
    }
}
