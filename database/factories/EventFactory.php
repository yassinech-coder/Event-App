<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
            'user_id' => rand(1,10),
            'title'=> $this->faker->title,
            'category_id' => rand(1,10),
            'description' => $this->faker->paragraph(rand(2,10)),
            'location' => $this->faker->address,
            'date' => $this->faker->DateTime,
            'time' => $this->faker->Time( 'H:i'),
            'seats' => $this->faker->numberBetween($min = 10, $max = 1000),
            'price' => $this->faker->numberBetween($min = 10, $max = 100),
          
        ];
    }
}
