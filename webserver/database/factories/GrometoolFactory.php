<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grometool>
 */
class GrometoolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $randomNumber1 = $this->faker->numberBetween(300,600)/10;
        $randomNumber2 = $this->faker->numberBetween(300,600)/10;
        $randomNumber3 = $this->faker->numberBetween(300,600)/10;
        // $randomNumber = $this->faker->num
        $setpoint = '{"variable":["humidity","temperature","light_intensity"], "data":{"humidity": ' .$randomNumber1 .',"temperature":'.$randomNumber2 .',"light_intensity":' . $randomNumber3 . '}}';
            // 'variable': {'a','b',''c'},
            // 'data': [{$randomNumber},{$randomNumber},{$randomNumber}],
        // }";
        // echo($setpoint);
        return [
            'name' => $this->faker->name(),
            'guid' => 'grome'.$this->faker->unique()->numberBetween(800000000,900000000),
            'setpoint' => $setpoint,
        ];
    }
}
