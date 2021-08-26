<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Models\Schedule;

class IsScheduleAvailable implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $id: is schedule_id.
     * @return bool
     */
    public function passes($attribute, $id)
    {
        $schedule = Schedule::with('participants')
            ->confirm()->find((int) $id, ['id', 'max_capacity']);

        // Melakukan pengecekan, apakah kegiatan masih tersedia (kapasitasnya)
        // saat melakukan pendaftaran.
        return $schedule->max_capacity >= $schedule->participants->count();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Maaf, :attribute yang dipilih telah penuh.';
    }
}
