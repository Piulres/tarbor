<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CrmNote
 *
 * @package App
 * @property string $customer
 * @property text $note
*/
class CrmNote extends Model
{
    protected $fillable = ['note', 'customer_id'];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        CrmNote::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCustomerIdAttribute($input)
    {
        $this->attributes['customer_id'] = $input ? $input : null;
    }
    
    public function customer()
    {
        return $this->belongsTo(CrmCustomer::class, 'customer_id');
    }
    
}
