<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class PhoneExistsInTable implements ValidationRule
{
    private $table;
    private $column;

    public function __construct($table, $column)
    {
        $this->table = $table;
        $this->column = $column;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!DB::table($this->table)->where($this->column, $value)->exists()) {
            $fail("Số điện thoại chưa được đăng ký.");
        }
    }
}
