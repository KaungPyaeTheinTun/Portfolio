<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Facades\Hash;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title'        => 'Bus Ticket Booking System',
                'description'  => 'A full-featured bus ticket booking platform with seat selection, online payment, and e-ticket generation. Supports multiple routes, bus operators, and real-time seat availability.',
                'technologies' => 'Laravel,MySQL,Bootstrap,jQuery,Stripe',
                'github_link'  => 'https://github.com/yourname/bus-booking',
                'live_demo'    => 'https://bus-booking.demo.com',
                'is_featured'  => true,
                'sort_order'   => 1,
            ],
            [
                'title'        => 'Training Management System',
                'description'  => 'An LMS for corporate training with course enrollment, progress tracking, certificates, and admin reporting dashboards. Supports video lectures and quizzes.',
                'technologies' => 'Laravel,Vue.js,MySQL,Redis,AWS S3',
                'github_link'  => 'https://github.com/yourname/training-ms',
                'live_demo'    => 'https://training.demo.com',
                'is_featured'  => true,
                'sort_order'   => 2,
            ],
            [
                'title'        => 'E-commerce System',
                'description'  => 'Multi-vendor e-commerce platform with product management, cart, wishlist, coupon system, order tracking, and integrated payment gateways (Stripe + PayPal).',
                'technologies' => 'Laravel,React,MySQL,Redis,Stripe,PayPal',
                'github_link'  => 'https://github.com/yourname/ecommerce',
                'live_demo'    => 'https://shop.demo.com',
                'is_featured'  => true,
                'sort_order'   => 3,
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(['title' => $project['title']], $project);
        }
    }
}