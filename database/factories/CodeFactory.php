<?php

namespace Database\Factories;

use App\Models\Code;
use Illuminate\Database\Eloquent\Factories\Factory;

class CodeFactory extends Factory
{
    protected $model = Code::class;

    public function definition(): array
    {
    	return [
    	    'unique_code' => $this->faker->unique()->regexify('[A-Za-z0-9]{7}'),
    	];
    }
}
