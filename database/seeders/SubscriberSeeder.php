<?php

namespace Database\Seeders;

use App\Models\Subscriber;
use App\Models\Topic;
use App\Models\User;
use App\Repositories\Interfaces\SubscriberRepository;
use Illuminate\Database\Seeder;

class SubscriberSeeder extends Seeder
{
    /**
     * @var SubscriberRepository
     */
    protected SubscriberRepository $repository;

    /**
     * SubscriberSeeder constructor.
     *
     * @param SubscriberRepository $repository
     */
    public function __construct(SubscriberRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::all()->each(function ($user) {
            $subscriber = Subscriber::create([
                'user_id' => $user->id,
            ]);

            $id = Topic::query()->inRandomOrder()->first()->id;

            $subscriber->topics()->atttach($id);
        });
    }
}
