<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CrmCustomer
 *
 * @package App
 * @property string $first_name
 * @property string $last_name
 * @property string $crm_status
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $skype
 * @property string $website
 * @property text $description
*/
class CrmCustomer extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'address', 'skype', 'website', 'description', 'crm_status_id'];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        CrmCustomer::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCrmStatusIdAttribute($input)
    {
        $this->attributes['crm_status_id'] = $input ? $input : null;
    }
    
    public function crm_status()
    {
        return $this->belongsTo(CrmStatus::class, 'crm_status_id');
    }
    
}
