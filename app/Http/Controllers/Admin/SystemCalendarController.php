<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public function index() 
    {
        $events = []; 

        foreach (\App\TimeEntry::all() as $timeentry) { 
           $crudFieldValue = $timeentry->getOriginal('start_time'); 

           if (! $crudFieldValue) {
               continue;
           }

           $eventLabel     = $timeentry->start_time; 
           $prefix         = ''; 
           $suffix         = ''; 
           $dataFieldValue = trim($prefix . " " . $eventLabel . " " . $suffix); 
           $events[]       = [ 
                'title' => $dataFieldValue, 
                'start' => $crudFieldValue, 
                'url'   => route('admin.timeentries.edit', $timeentry->id)
           ]; 
        } 


       return view('admin.calendar' , compact('events')); 
    }

}
